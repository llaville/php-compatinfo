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

/**
 * Octal Number Format (with 0o prefix) since PHP 8.1
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.1/en.php#explicit_octal_numeral_notation
 * @link https://wiki.php.net/rfc/explicit_octal_notation
 * @link https://php.watch/versions/8.1/explicit-octal-notation
 * @see tests/Sniffs/OctalNumberFormatSniffTest
 */
final class OctalNumberFormatSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8108';
    /** @var array<int, mixed> */
    private array $tokens;

    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Explicit Octal numeral notation is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
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
        if (!$this->isOctalNumberFormat($node)) {
            return null;
        }

        $this->updateNodeElementVersion(
            $node,
            $this->attributeKeyStore,
            ['ext.name' => 'core', 'ext.min' => '8.1.0', 'php.min' => '8.1.0alpha1']
        );
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
        return null;
    }

    private function isOctalNumberFormat(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');

        if ($node instanceof Node\Scalar\LNumber && isset($this->tokens[$i][1])) {
            return (substr_compare($this->tokens[$i][1], '0o', 0, 2, true) === 0);
        }
        return false;
    }
}
