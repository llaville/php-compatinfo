<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Application\Sniffs\ControlStructures;

use Bartlett\CompatInfo\Application\Sniffs\KeywordBag;
use Bartlett\CompatInfo\Application\Sniffs\SniffAbstract;

use PhpParser\Node;

/**
 * Declare control structures
 *
 * @link https://www.php.net/manual/en/control-structures.declare.php
 * @link https://wiki.php.net/rfc/scalar_type_hints_v5#strict_types_declare_directive
 *
 * @see tests/Sniffs/DeclareSniffTest
 * @since Class available since Release 5.4.0
 */
final class DeclareSniff extends SniffAbstract
{
    /** @var KeywordBag */
    private $directives;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->directives = new KeywordBag(
            [
                'ticks' => '4.0',
                'encoding' => '5.3',
                'strict_types' => '7.0',
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\Declare_) {
            return null;
        }

        foreach ($node->declares as $declare) {
            $key = (string) $declare->key;

            $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => $this->directives->get($key)]);
        }
    }
}
