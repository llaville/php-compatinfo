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
 * Readonly Properties syntax (since PHP 8.1)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://www.php.net/manual/en/language.oop5.properties.php#language.oop5.properties.readonly-properties
 * @link https://wiki.php.net/rfc/readonly_properties_v2
 * @see tests/Sniffs/ReadonlyPropertySniffTest.php
 */
final class ReadonlyPropertySniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8102';

    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Readonly Properties is available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/components/sniffs/PHP81',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if ($node instanceof Node\Stmt\Property) {
            if ($node->flags & Node\Stmt\Class_::MODIFIER_READONLY) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0beta1']);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
            }
            return null;
        }

        if ($node instanceof Node\FunctionLike) {
            foreach ($node->getParams() as $param) {
                if ($param->isReadonly()) {
                    $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0beta1']);
                    $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
                    break;
                }
            }
        }

        return null;
    }
}
