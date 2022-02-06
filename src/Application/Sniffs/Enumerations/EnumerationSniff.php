<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Enumerations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Enumerations syntax (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.enumerations.php
 * @link https://php.watch/versions/8.1/enums
 * @see tests/Sniffs/EnumerationSniffTest.php
 */
final class EnumerationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8101';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Enumeration syntax is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Enum_) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0alpha1']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
        return null;
    }
}
