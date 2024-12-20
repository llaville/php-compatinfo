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

    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Trailing comma syntax is available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP80',
        ];
    }

    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if ($node instanceof Node\Stmt\Function_) {
            $trailingCommaFound = $this->checkParamsList($node);
        } elseif ($node instanceof Node\Expr\Closure) {
            // first attempt with closure parameters
            $trailingCommaFound = $this->checkParamsList($node);
            if (!$trailingCommaFound) {
                // second attempt with closure use list
                $trailingCommaFound = $this->checkUsesList($node);
            }
        } else {
            $trailingCommaFound = false;
        }
        if (!$trailingCommaFound) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0alpha1']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA80);
        return null;
    }

    private function checkParamsList(Node\FunctionLike $node): bool
    {
        $params = $node->getParams();
        $argCount = count($params);
        if ($argCount === 0) {
            // without parameters, no need to check
            return false;
        }
        $returnType = $node->getReturnType();

        $startTokenPos = $params[0]->getAttribute('startTokenPos');
        // CAUTION: depending on code context, this position is probably wrong
        $endTokenPos = $params[$argCount - 1]->getAttribute('endTokenPos');
        // fallback strategy follows
        if ($node instanceof Node\Expr\Closure && !empty($node->uses)) {
            $endTokenPos = $node->uses[0]->getAttribute('startTokenPos');
        } elseif ($returnType !== null) {
            // function or closure with return type
            $endTokenPos = $returnType->getAttribute('startTokenPos');
        } elseif (!empty($node->stmts)) {
            // function or closure with body
            $endTokenPos = $node->stmts[0]->getAttribute('startTokenPos');
        } else {
            // function or closure without body
            $endTokenPos = $node->getAttribute('endTokenPos');
        }

        return $this->isTrailingComma($startTokenPos, $endTokenPos, $argCount);
    }

    private function checkUsesList(Node\Expr\Closure $node): bool
    {
        $argCount = count($node->uses);
        if ($argCount === 0) {
            // without use list, no need to check
            return false;
        }

        $startTokenPos = $node->uses[0]->getAttribute('startTokenPos');
        // CAUTION: depending on code context, this position may be wrong
        $endTokenPos = $node->uses[$argCount - 1]->getAttribute('endTokenPos');
        // fallback strategy follows
        if ($node->returnType !== null) {
            // function or closure with return type
            $endTokenPos = $node->returnType->getAttribute('startTokenPos');
        } elseif (!empty($node->stmts)) {
            // function or closure with body
            $endTokenPos = $node->stmts[0]->getAttribute('startTokenPos');
        } else {
            // function or closure without body
            $endTokenPos = $node->getAttribute('endTokenPos');
        }

        return $this->isTrailingComma($startTokenPos, $endTokenPos, $argCount);
    }

    private function isTrailingComma(int $startTokenPos, int $endTokenPos, int $argCount): bool
    {
        $tokens = array_slice($this->tokens, $startTokenPos, $endTokenPos - $startTokenPos);

        $commas = array_filter($tokens, function ($token) {
            return (',' == $token->text);
        });

        return (count($commas) && count($commas) == $argCount);
    }
}
