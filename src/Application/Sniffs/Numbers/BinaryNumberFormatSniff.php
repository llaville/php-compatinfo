<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Numbers;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function substr_compare;

/**
 * Binary Number Format (with 0b prefix) since PHP 5.4
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 * @see tests/Sniffs/BinaryNumberFormatSniffTest
 */
final class BinaryNumberFormatSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA54 = 'CA5406';
    /** @var array<int, mixed> */
    private array $tokens;

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
        if (!$this->isBinaryNumberFormat($node)) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['ext.name' => 'core', 'ext.min' => '5.4.0', 'php.min' => '5.4.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA54);
        return null;
    }

    public function getRules(): Generator
    {
        yield self::CA54 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Binary Number Format (with 0b prefix) is available since PHP 5.4.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-54',
        ];
    }

    private function isBinaryNumberFormat(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');

        if ($node instanceof Node\Scalar\LNumber && isset($this->tokens[$i][1])) {
            return (substr_compare($this->tokens[$i][1], '0b', 0, 2, true) === 0);
        }
        return false;
    }
}
