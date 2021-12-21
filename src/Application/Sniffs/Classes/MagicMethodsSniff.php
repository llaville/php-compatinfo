<?php declare(strict_types=1);

/**
 * Report use of magic methods
 *
 * @link https://www.php.net/manual/en/language.oop5.magic.php
 *
 * @see tests/Sniffs/MagicMethodsSniffTest
 */

namespace Bartlett\CompatInfo\Application\Sniffs\Classes;

use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

use Generator;
use function implode;

/**
 * @since Release 5.4.0
 */
final class MagicMethodsSniff extends SniffAbstract
{
    // Rules identifiers for SARIF report
    private const CA51 = 'CA5101';
    private const CA53 = 'CA5301';
    private const CA56 = 'CA5601';

    /** @var string[] */
    private $mm503;
    /** @var string[] */
    private $mm506;
    /** @var string[] */
    private $mm501;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->mm501 = ['__isset', '__unset', '__set_state'];
        $this->mm503 = ['__callStatic', '__invoke'];
        $this->mm506 = ['__debugInfo'];
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if (!$node instanceof Node\Stmt\ClassMethod) {
            return null;
        }

        $name = (string) $node->name;

        if (in_array($name, $this->mm501)) {
            $min = '5.1.0';
            $id = self::CA51;
        } elseif (in_array($name, $this->mm503)) {
            $min = '5.3.0';
            $id = self::CA53;
        } elseif (in_array($name, $this->mm506)) {
            $min = '5.6.0';
            $id = self::CA56;
        } else {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $min]);
        $this->updateNodeElementRule($node, $this->attributeKeyStore, $id);
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRules(): Generator
    {
        yield self::CA51 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'The following method names are considered magical'
                . ' since PHP 5.1: ' . implode(', ', $this->mm501),
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-51',
        ];
        yield self::CA53 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'The following method names are considered magical'
                . ' since PHP 5.3: ' . implode(', ', $this->mm503),
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-53',
        ];
        yield self::CA56 => [
            'name' => $this->getShortClass(),
            'fullDescription' => 'The following method names are considered magical'
                . ' since PHP 5.6: ' . implode(', ', $this->mm506),
            'helpUri' => '%baseHelpUri%/01_Components/03_Sniffs/Features/#php-56',
        ];
    }
}
