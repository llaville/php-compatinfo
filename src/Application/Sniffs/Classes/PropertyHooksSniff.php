<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Property hooks declarations
 *
 * @author Laurent Laville
 * @since Release 7.2.0
 *
 * @link https://wiki.php.net/rfc/property-hooks
 * @link https://www.php.net/manual/en/language.oop5.property-hooks.php
 * @link https://www.php.net/manual/en/migration84.new-features.php#migration84.new-features.core.property-hooks
 * @link https://www.zend.com/blog/php-8-4-property-hooks
 * @link https://ashallendesign.co.uk/blog/php-84-property-hooks
 * @see tests/Sniffs/PropertyHooksSniffTest
 */
final class PropertyHooksSniff extends SniffAbstract
{
    private const CA84 = 'CA8401';

    public function getRules(): Generator
    {
        yield self::CA84 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Property Hooks are available since PHP 8.4.0',
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP84',
        ];
    }

    /**
     * @inheritdoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if ($node instanceof Node\Scalar\MagicConst\Property) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.4.0']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA84);
            return null;
        }

        if (!$node instanceof Node\Stmt\Property) {
            return null;
        }

        if (empty($node->hooks)) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.4.0']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA84);
        return null;
    }
}
