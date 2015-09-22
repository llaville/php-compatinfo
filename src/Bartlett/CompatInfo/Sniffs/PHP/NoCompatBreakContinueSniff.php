<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * {Description}
 * The break and continue statements no longer accept variable
 * arguments (e.g., break 1 + foo() * $bar;). Static arguments
 * still work, such as break 2;. As a side effect of this change
 * break 0; and continue 0; are no longer allowed.
 *
 * {Errmsg}
 * Fatal error: 'break' operator with non-constant operand is no longer supported
 * Fatal error: 'break' operator accepts only positive numbers
 *
 * {Reference}
 * http://php.net/manual/en/control-structures.continue.php
 * http://php.net/manual/en/control-structures.break.php
 * http://php.net/manual/en/migration54.incompatible.php
 */
class NoCompatBreakContinueSniff extends SniffAbstract
{
    private $noCompat;

    public function setUpBeforeSniff()
    {
        parent::setUpBeforeSniff();

        $this->noCompat = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->noCompat)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::NO_COMPAT_BREAK => $this->noCompat)
            );
        }
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Break_) {
            $operator = 'break';

        } elseif ($node instanceof Node\Stmt\Continue_) {
            $operator = 'continue';

        } else {
            return;
        }

        $version  = '5.4.0';
        $severity = $this->getCurrentSeverity($version, 'lt');

        if (!is_null($node->num) && !($node->num instanceof Node\Scalar\LNumber)) {
            $message = sprintf(
                '<info>%s</info> operator with non-constant operand is no longer supported',
                $operator
            );

        } elseif ($node->num instanceof Node\Scalar\LNumber && $node->num->value < 1) {
            $message = sprintf(
                '<info>%s</info> operator accepts only positive numbers',
                $operator
            );

        } else {
            return;
        }

        if (!isset($this->noCompat[$operator])) {
            $this->noCompat[$operator] = array(
                'severity' => $severity,
                'version'  => $version,
                'message'  => $message,
                'spots'    => array()
            );
        }
        $this->noCompat[$operator]['spots'][] = $this->getCurrentSpot($node);
    }
}
