<?php declare(strict_types=1);

/**
 * Specific text processing with PHP crypt function.
 *
 * @link https://www.php.net/manual/en/function.crypt.php
 *
 * @see tests/Sniffs/CryptStringSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\TextProcessing;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;
use PhpParser\Node;

use function in_array;
use function substr;

/**
 * @since Release 5.4.0
 */
final class CryptStringSniff extends SniffAbstract
{
    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Expr\FuncCall) {
            return null;
        }

        if (!$node->name instanceof Node\Name) {
            // indirect name not resolved
            return null;
        }

        if (strcasecmp('crypt', (string) $node->name) !== 0) {
            // not crypt function
            return null;
        }

        if (count($node->args) < 2) {
            // $salt argument is not specified
            return null;
        }

        $salt = $node->args[1]->value;

        if (!$salt instanceof Node\Scalar\String_) {
            // indirect salt value not resolved
            return null;
        }

        if (in_array(substr($salt->value, 0, 4), ['$2a$', '$2x$', '$2y$'])) {
            // Blowfish
            $min = '5.3.7';
        } elseif (in_array(substr($salt->value, 0, 3), ['$5$', '$6$'])) {
            // SHA-256 and SHA-512
            $min = '5.3.2';
        } elseif (in_array(substr($salt->value, 0, 3), ['$1$'])) {
            // SHA-256 and SHA-512
            $min = '5.3.0';
        } else {
            $min = '4.0.0';
        }

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min, 'ext.name' => 'standard']);
        return null;
    }
}
