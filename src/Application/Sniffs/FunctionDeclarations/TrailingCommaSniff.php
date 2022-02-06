<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function array_filter;
use function array_slice;
use function count;
use function is_string;

/**
 * Trailing comma in parameters list and closure use list (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/trailing_comma_in_parameter_list
 * @link https://wiki.php.net/rfc/trailing_comma_in_closure_use_list
 * @link https://php.watch/versions/8.0/trailing-comma-parameter-use-list
 * @see tests/Sniffs/TrailingCommaSniffTest.php
 */
final class TrailingCommaSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8006';
    /** @var array<int, mixed> */
    private array $tokens;

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Trailing comma syntax is available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Function_) {
            $argCount = count($node->params);
            if (!$this->isTrailingComma($node, $argCount)) {
                return null;
            }
        } elseif ($node instanceof Node\Expr\Closure) {
            $argCount = count($node->params);
            // first attempt with closure parameters
            if (!$this->isTrailingComma($node, $argCount)) {
                $argCount = count($node->uses);
                // second attempt with closure use list
                if (!$this->isTrailingComma($node, $argCount)) {
                    return null;
                }
            }
        } else {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0alpha1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA80);
        return null;
    }

    private function isTrailingComma(Node $node, int $argCount): bool
    {
        $i = $node->getAttribute('startTokenPos');
        $l = $node->getAttribute('endTokenPos');

        $tokens = array_slice($this->tokens, $i, $l - $i);

        $commas = array_filter($tokens, function ($token) {
            return (is_string($token) && ',' == $token);
        });

        return (count($commas) && count($commas) == $argCount);
    }
}
