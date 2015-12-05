<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Use of short open tag is always available since PHP 5.4
 *
 */
class ShortOpenTagSniff extends SniffAbstract
{
    private $shortOpenTag;
    private $tokens;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->shortOpenTag = array();

        $this->tokens = $this->visitor->getTokens();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->shortOpenTag)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::SHORT_OPEN_TAG => $this->shortOpenTag)
            );
        }
    }

    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if (($node instanceof Node\Stmt\Echo_ || $node instanceof Node\Stmt\InlineHTML)
            && $this->isShortOpenTag($node)
        ) {
            $name = '#';

            if (empty($this->shortOpenTag)) {
                $version = '5.4.0';

                $this->shortOpenTag[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->shortOpenTag[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isShortOpenTag($node)
    {
        $i = $node->getAttribute('startTokenPos');
        return (strpos($this->tokens[$i][1], '<?=') === 0);
    }
}
