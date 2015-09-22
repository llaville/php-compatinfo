<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Exponentiation is PHP 5.6 or greater
 *
 * @link https://github.com/llaville/php-compat-info/issues/142
 * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.exponentiation
 * @link https://github.com/wimg/PHPCompatibility/issues/60
 */
class ExponantiationSniff extends SniffAbstract
{
    private $exponantiation;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->exponantiation = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->exponantiation)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::EXPONANTIATION => $this->exponantiation)
            );
        }
    }

    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if ($this->isPowOperator($node)) {
            $name = '#';

            if (empty($this->exponantiation)) {
                $version = '5.6.0';

                $this->exponantiation[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }

            $this->exponantiation[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isPowOperator($node)
    {
        return ($node instanceof Node\Expr\BinaryOp\Pow
            || $node instanceof Node\Expr\AssignOp\Pow
        );
    }
}
