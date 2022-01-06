<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Constants;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use PhpParser\Node;

use Generator;
use function strcasecmp;

/**
 * The Foo\Bar::class syntax has been introduced in PHP 5.5
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://wiki.php.net/rfc/class_name_literal_on_object
 * @see tests/Sniffs/MagicClassConstantSniffTest
 */
final class MagicClassConstantSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA55 = 'CA5501';

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\ClassConstFetch) {
            return null;
        }

        if (!($node->name instanceof Node\Identifier && strcasecmp('class', (string) $node->name) === 0)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.5.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA55);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA55 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "The Foo\Bar::class syntax has been introduced in PHP 5.5.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-55',
        ];
    }
}
