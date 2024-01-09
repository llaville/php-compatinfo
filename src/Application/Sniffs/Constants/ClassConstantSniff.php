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

/**
 * Class constants
 *
 * @author Laurent Laville
 * @since Release 5.4.0
 *
 * @link https://www.php.net/manual/en/language.oop5.constants.php
 * @link https://www.php.net/releases/8.1/en.php#final_class_constants
 * @link https://wiki.php.net/rfc/final_class_const
 * @link https://php.watch/versions/8.1/final-class-const
 * @see tests/Sniffs/ClassConstantSniffTest
 */
final class ClassConstantSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA81 = 'CA8107';

    public function getRules(): Generator
    {
        yield self::CA81 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Final class constants are available since PHP 8.1.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-81',
        ];
    }

    /**
     * @inheritDoc
     */
    public function enterNode(Node $node): int|Node|null
    {
        if (!$node instanceof Node\Stmt\ClassConst) {
            return null;
        }

        if ($node->isFinal()) {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.1.0beta1']);
            $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA81);
        } else {
            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '4.0.0']);
        }
        return null;
    }
}
