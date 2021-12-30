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

/**
 * Class constants
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/language.oop5.constants.php
 * @see tests/Sniffs/ClassConstantSniffTest
 */
final class ClassConstantSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\ClassConst) {
            return null;
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '4.0.0']);
        return null;
    }
}
