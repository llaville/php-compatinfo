<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Short array syntax (since PHP 5.4)
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/47
 * @link https://github.com/llaville/php-compat-info/issues/148
 *       Array short syntax and array dereferencing not detected
 * @link http://php.net/manual/en/migration54.new-features.php
 */
class ShortArraySyntaxSniff extends SniffAbstract
{
    private $shortArraySyntax;
    private $tokens;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->shortArraySyntax = array();

        $this->tokens = $this->visitor->getTokens();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->shortArraySyntax)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::SHORT_ARRAY_SYNTAX => $this->shortArraySyntax)
            );
        }
    }

    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        if ($node instanceof Node\Expr\Array_
            && $this->isShortArraySyntax($node)
        ) {
            $name = '#';

            if (empty($this->shortArraySyntax)) {
                $version = '5.4.0';

                $this->shortArraySyntax[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->shortArraySyntax[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isShortArraySyntax($node)
    {
        $i = $node->getAttribute('startTokenPos');
        return is_string($this->tokens[$i]);
    }
}
