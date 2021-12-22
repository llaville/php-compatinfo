<?php declare(strict_types=1);

/**
 * Specific text processing with PHP crypt function.
 *
 * @link https://www.php.net/manual/en/function.crypt.php
 *
 * @see tests/Sniffs/CryptStringSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\TextProcessing;

use Bartlett\CompatInfo\Application\Sniffs\KeywordBag;
use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function in_array;
use function sprintf;
use function substr;

/**
 * @since Release 5.4.0
 */
final class CryptStringSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA53 = 'CA5305';
    private KeywordBag $algorithms;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->algorithms = new KeywordBag(
            [
                'BLOWFISH' => '5.3.7',
                'SHA-256' => '5.3.2',
                'SHA-512' => '5.3.2',
                'MD5' => '5.3.0',
            ]
        );
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
            $algorithm = 'BLOWFISH';
            $id = sprintf('%s/%s', self::CA53, $algorithm);
        } elseif (in_array(substr($salt->value, 0, 3), ['$5$'])) {
            $algorithm = 'SHA-256';
            $id = sprintf('%s/%s', self::CA53, $algorithm);
        } elseif (in_array(substr($salt->value, 0, 3), ['$6$'])) {
            $algorithm = 'SHA-512';
            $id = sprintf('%s/%s', self::CA53, $algorithm);
        } elseif (in_array(substr($salt->value, 0, 3), ['$1$'])) {
            $algorithm = 'MD5';
            $id = sprintf('%s/%s', self::CA53, $algorithm);
        } else {
            $algorithm = 'DES';
            $id = '';
        }
        $min = $this->algorithms->get($algorithm);

        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min, 'ext.name' => 'standard']);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        foreach ($this->algorithms->all() as $algorithm => $min) {
            yield self::CA53 => [
                'name' => $this->getShortClass(),
                'fullDescription' => sprintf(
                    "String hashing algorithm '%s' is allowed since PHP %s",
                    $algorithm,
                    $min
                ),
                'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
            ];
        }
    }
}
