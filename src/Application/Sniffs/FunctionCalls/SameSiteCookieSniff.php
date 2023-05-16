<?php declare(strict_types=1);
/**
 * This file is part of the PHP_CompatInfo package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Bartlett\CompatInfo\Application\Sniffs\FunctionCalls;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function count;
use function in_array;
use function strtolower;

/**
 * Set(raw)cookie accept $options argument.
 *
 * @link https://php.watch/versions/7.3/same-site-cookies
 * @link https://wiki.php.net/rfc/same-site-cookie
 * @link https://www.php.net/manual/en/migration73.other-changes.php
 * @link https://github.com/llaville/php-compatinfo/issues/359
 *
 * @see tests/Sniffs/SameSiteCookieSniffTest.php
 *
 * @author Laurent Laville
 * @since  Class available since Release 6.5.5
 */
final class SameSiteCookieSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA73 = 'CA7301';

    /**
     * {@inheritDoc}
     */
    public function getRules(): Generator
    {
        yield self::CA73 => [
            'name' => $this->getShortClass(),
            'fullDescription' => "Set(raw)cookie alternative signature is allowed since PHP 7.3.0",
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-73',
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
        if (!$node->name instanceof Node\Name) {
            return null;
        }
        $functionName = strtolower($node->name->toString());

        if (!in_array($functionName, ['setcookie', 'setrawcookie', 'session_set_cookie_params'])) {
            return null;
        }

        $arguments = $node->args;

        if ('session_set_cookie_params' === $functionName) {
            if ($arguments[0]->value instanceof Node\Expr\Array_) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.3.0beta1']);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA73);
            }
        } else {
            if (count($arguments) > 2 && $arguments[2]->value instanceof Node\Expr\Array_) {
                $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '7.3.0beta1']);
                $this->updateNodeElementRule($node, $this->attributeKeyStore, self::CA73);
            }
        }

        return null;
    }
}
