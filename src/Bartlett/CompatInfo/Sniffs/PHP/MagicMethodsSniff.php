<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Report use of magic methods not supported
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/64
 */
class MagicMethodsSniff extends SniffAbstract
{
    private $mm501;
    private $mm503;
    private $mm506;

    private $magicMethods;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->mm501 = array('__isset', '__unset', '__set_state');
        $this->mm503 = array('__callStatic', '__invoke');
        $this->mm506 = array('__debugInfo');

        $this->magicMethods = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->magicMethods)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::MAGIC_METHODS => $this->magicMethods)
            );
        }
    }

    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if ($node instanceof Node\Stmt\ClassMethod) {
            $name = $node->name;

            if (in_array($name, $this->mm501)) {
                $version = '5.1.0';

            } elseif (in_array($name, $this->mm503)) {
                $version = '5.3.0';

            } elseif (in_array($name, $this->mm506)) {
                $version = '5.6.0';

            } else {
                return;
            }

            if (!isset($this->magicMethods[$name])) {
                $this->magicMethods[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->magicMethods[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
