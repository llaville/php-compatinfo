<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Binary Number Format (with 0b prefix) since PHP 5.4
 *
 * @link http://php.net/manual/en/migration54.new-features.php
 * @link https://github.com/wimg/PHPCompatibility/issues/55
 */
class GlobalSniff extends SniffAbstract
{
    private $binaryNumberFormat;
    private $tokens;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->binaryNumberFormat = array();

        $this->tokens = $this->visitor->getTokens();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->binaryNumberFormat)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array('BinaryNumberFormat' => $this->binaryNumberFormat)
            );
        }
    }

    /**
     * @param Node $node
     * @return void
     */
    public function leaveNode(Node $node): void
    {
        parent::leaveNode($node);

        if ($this->isBinaryNumberFormat($node)) {
            $name = '#';

            if (empty($this->binaryNumberFormat)) {
                $this->binaryNumberFormat[$name] = array(
                    'version' => '5.4.0',
                    'spots'   => array()
                );
            }
            $this->binaryNumberFormat[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isBinaryNumberFormat(Node $node): bool
    {
        $i = $node->getAttribute('startTokenPos');
        return ($node instanceof Node\Scalar\LNumber
            && substr_compare($this->tokens[$i][1], '0b', 0, 2, true) === 0
        );
    }
}
