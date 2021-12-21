<?php declare(strict_types=1);

/**
 * The Foo\Bar::class syntax has been introduced in PHP 5.5
 *
 * @link https://wiki.php.net/rfc/class_name_literal_on_object
 *
 * @see tests/Sniffs/MagicClassConstantSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Constants;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use PhpParser\Node;

use Generator;
use function strcasecmp;

/**
 * @since Release 5.4.0
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
