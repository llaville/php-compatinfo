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
 * Constructor property promotion (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.oop5.decon.php#language.oop5.decon.constructor.promotion
 * @link https://wiki.php.net/rfc/constructor_promotion
 * @link https://php.watch/versions/8.0/constructor-property-promotion
 * @see tests/Sniffs/PropertyPromotionSniffTest.php
 */
final class PropertyPromotionSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8003';

    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Constructor property promotion is available since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP80',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\FunctionLike) {
            return null;
        }

        $versions = $node->getAttribute($this->attributeKeyStore);

        foreach ($node->getParams() as $param) {
            if ($param->flags !== 0) {
                // @see https://github.com/nikic/PHP-Parser/pull/667 for PHP-Parser implementation
                $this->updateVersion('8.0.0alpha1', $versions['php.min']);
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, $versions);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA80);
                break;
            }
        }
        return null;
    }
}
