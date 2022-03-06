<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\ControlStructures;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Non-capturing catches syntax (available since PHP 8.0)
 *
 * @author Laurent Laville
 * @since Release 6.2.0
 *
 * @link https://wiki.php.net/rfc/non-capturing_catches
 * @link https://php.watch/versions/8.0/catch-exception-type
 * @see tests/Sniffs/NonCapturingCatchSniffTest
 */
final class NonCapturingCatchSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8007';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Catching exceptions without capturing them to variables is only possible since PHP 8.0.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Catch_) {
            return null;
        }
        if (!$parent = $node->getAttribute($this->attributeParentKeyStore)) {
            return null;
        }
        if (null === $node->var) {
            $this->updateNodeElementVersion($parent, $this->attributeKeyStore, ['php.min' => '8.0.0alpha1']);
            $this->updateNodeElementRule($parent, $this->attributeKeyStore, self::CA80);
        }
        return null;
    }
}
