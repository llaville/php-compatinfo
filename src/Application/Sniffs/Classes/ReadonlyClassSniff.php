<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use Generator;
use PhpParser\Node;

/**
 * Readonly Class syntax (since PHP 8.2)
 *
 * @author Laurent Laville
 * @since Release 7.0.1
 *
 * @link https://wiki.php.net/rfc/readonly_classes
 * @link https://php.watch/versions/8.2/readonly-classes
 * @see tests/Sniffs/ReadonlyClassSniffTest.php
 */
final class ReadonlyClassSniff extends SniffAbstract
{
    private const CA82 = 'CA8201';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA82 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Readonly Classes are available since PHP 8.2.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-82',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Class_) {
            return null;
        }

        if ($node->flags & Node\Stmt\Class_::MODIFIER_READONLY) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.2.0alpha1']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA82);
        }
        return null;
    }
}
