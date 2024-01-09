<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\TextProcessing;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use Generator;
use PhpParser\Node;

/**
 * Deprecate Dollar Brace String Interpolation since PHP 8.2.0 alpha1
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/deprecate_dollar_brace_string_interpolation
 * @see tests/Sniffs/DeprecateDollarBraceStringInterpolationSniffTest
 */
final class DeprecateDollarBraceStringInterpolationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA82 = 'CA8206';
    /** @var array<int, mixed> */
    private array $tokens;

    public function getRules(): Generator
    {
        yield self::CA82 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Deprecated \${} interpolation since PHP 8.2.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-82',
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
    public function leaveNode(Node $node): array|int|Node|null
    {
        if (!$this->isStringInterpolationSyntax($node)) {
            return null;
        }

        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }

        $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.2.0alpha1']);
        $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA82);
        return null;
    }

    private function isStringInterpolationSyntax(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return ($node instanceof Node\Scalar\Encapsed && $this->tokens[$i + 1][1] == '${');
    }
}
