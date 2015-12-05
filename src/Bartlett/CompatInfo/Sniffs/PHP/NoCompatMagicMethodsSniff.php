<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 *
 * {Description}
 * The magic methods __get(), __set(), __isset(), __unset(), and
 * __call() must always be public and can no longer be static. Method
 * signatures are now enforced.
 *
 * {Errmsg}
 * Warning: The magic method {method} must have public visibility and cannot be static
 *
 * {Reference}
 * http://php.net/manual/en/migration53.incompatible.php
 *
 *
 * {Description}
 * The __toString() magic method can no longer accept arguments.
 *
 * {Errmsg}
 * Fatal error: Method {class}::__tostring() cannot take arguments
 *
 *
 */
class NoCompatMagicMethodsSniff extends SniffAbstract
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
                array(Metrics::NO_COMPAT_MAGIC => $this->noCompat)
            );
        }
    }

    public function enterNode(Node $node)
    {
        if (!$node instanceof Node\Stmt\ClassMethod) {
            return;
        }
        if (!in_array(
            $node->name,
            array(
                '__get', '__set', '__isset', '__unset', '__call', '__toString',
            )
        )) {
            return;
        }
        $name = $node->name;

        if ('__toString' == $name) {
            if (count($node->params) == 0) {
                return;
            }
            $message = sprintf(
                'Magic Method <info>%s()</info> cannot take arguments',
                $name
            );
        } else {
            if (!$node->isPublic() || $node->isStatic()) {
                $message = sprintf(
                    'Magic method <info>%s()</info> must have public visibility and cannot be static',
                    $name
                );
            } else {
                return;
            }
        }
        $version  = '5.3.0';
        $severity = $this->getCurrentSeverity($version, 'lt', 'warning');

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
