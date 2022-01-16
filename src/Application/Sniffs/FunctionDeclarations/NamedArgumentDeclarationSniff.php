<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\FunctionDeclarations;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;

/**
 * Named arguments Declaration
 *
 * @author Laurent Laville
 * @since Class available since Release 6.2.0
 *
 * @link https://www.php.net/releases/8.0/en.php#named-arguments
 * @link https://wiki.php.net/rfc/named_params
 * @link https://www.php.net/manual/en/functions.arguments.php#functions.named-arguments
 * @link https://php.watch/versions/8.0/named-parameters
 * @see tests/Sniffs/NamedArgumentDeclarationSniffTest
 */
final class NamedArgumentDeclarationSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA80 = 'CA8001';

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA80 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'Named arguments is available since PHP 8.0.0',
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-80',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\FuncCall) {
            return null;
        }

        foreach ($node->getRawArgs() as $arg) {
            if ($arg instanceof Node\Arg && $arg->name !== null) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '8.0.0beta1']);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA80);
                break;
            }
        }

        return null;
    }
}
