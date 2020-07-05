<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Array dereferencing syntax (since PHP 5.4)
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/52
 * @link https://github.com/llaville/php-compat-info/issues/148
 *       Array short syntax and array dereferencing not detected
 * @link http://php.net/manual/en/migration54.new-features.php
 */
class ArrayDereferencingSyntaxSniff extends SniffAbstract
{
    private $arrayDereferencingSyntax;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->arrayDereferencingSyntax = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->arrayDereferencingSyntax)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::ARRAY_DEREFERENCING_SYNTAX => $this->arrayDereferencingSyntax)
            );
        }
    }

    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        if ($node instanceof Node\Expr\ArrayDimFetch
            && $node->var instanceof Node\Expr\FuncCall
        ) {
            $name = '#';

            if (empty($this->arrayDereferencingSyntax)) {
                $version = '5.4.0';

                $this->arrayDereferencingSyntax[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->arrayDereferencingSyntax[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
