<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * {Description}
 * Parameter names that shadow super globals now cause a fatal error.
 * This prohibits code like function foo($_GET, $_POST) {}.
 *
 * {Errmsg}
 * Fatal error: Cannot re-assign auto-global variable
 * Fatal error: Cannot re-assign $this
 *
 * {Reference}
 * http://php.net/manual/en/migration54.incompatible.php
 */
class NoCompatParamSniff extends SniffAbstract
{
    private $noCompat;

    private $autoGlobals = array(
        '_SESSION', '_GET', '_POST', '_COOKIE', '_SERVER', '_ENV', '_REQUEST', '_FILES'
    );

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
                array(Metrics::NO_COMPAT_PARAM => $this->noCompat)
            );
        }
    }

    public function leaveNode(Node $node)
    {
        if (($node instanceof Node\FunctionLike)
            && $this->hasParamShadowGlobal($node)
        ) {
            $name     = '#';
            $version  = '5.4.0';
            $severity = $this->getCurrentSeverity($version, 'lt');
            $message  = 'Cannot re-assign auto-global variable';

            if (!isset($this->noCompat[$name])) {
                $this->noCompat[$name] = array(
                    'severity' => $severity,
                    'version'  => $version,
                    'message'  => $message,
                    'spots'    => array()
                );
            }
            $this->noCompat[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function hasParamShadowGlobal(Node $node)
    {
        foreach ($node->params as $param) {
            // auto-global
            if (in_array($param->name, $this->autoGlobals)) {
                return true;

            // $this
            } elseif ($param->name == 'this'
                && $node instanceof Node\Stmt\ClassMethod
                && !$node->isStatic()
            ) {
                return true;
            }
        }
        return false;
    }
}
