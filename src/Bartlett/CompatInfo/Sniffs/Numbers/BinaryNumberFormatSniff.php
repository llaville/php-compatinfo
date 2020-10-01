<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\Numbers;

use Bartlett\CompatInfo\Sniffs\SniffAbstract;

use PhpParser\Node;

use function substr_compare;

/**
 * Binary Number Format (with 0b prefix) since PHP 5.4
 *
 * @link https://www.php.net/manual/en/migration54.new-features.php
 *
 * @see tests/Sniffs/BinaryNumberFormatSniffTest
 * @since Class available since Release 5.4.0
 */
final class BinaryNumberFormatSniff extends SniffAbstract
{
    /** @var array */
    private $tokens;

    /**
     * {@inheritDoc}
     */
    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->tokens = $this->visitor->getTokens();
    }

    /**
     * {@inheritDoc}
     */
    public function leaveNode(Node $node)
    {
        if (!$this->isBinaryNumberFormat($node)) {
            return null;
        }
        $this->updateNodeElementVersion($node, $this->attributeKeyStore, ['php.min' => '5.4.0']);
    }

    private function isBinaryNumberFormat(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return ($node instanceof Node\Scalar\LNumber
            && substr_compare($this->tokens[$i][1], '0b', 0, 2, true) === 0
        );
    }
}
