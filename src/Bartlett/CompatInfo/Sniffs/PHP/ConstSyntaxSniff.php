<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Use of CONST keyword outside of a class (since PHP 5.3)
 * Constant scalar expressions are PHP 5.6 or greater
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/50
 */
class ConstSyntaxSniff extends SniffAbstract
{
    private $constSyntax;

    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->constSyntax = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->constSyntax)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::CONST_SYNTAX => $this->constSyntax)
            );
        }
    }

    public function enterNode(Node $node): void
    {
        parent::enterNode($node);

        if (!$node instanceof Node\Stmt\Const_) {
            return;
        }

        if (!$this->visitor->inContext('object')) {
            $name = '#';

            if (empty($this->constSyntax)) {
                $version = '5.3.0';

                $this->constSyntax[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->constSyntax[$name]['spots'][] = $this->getCurrentSpot($node);
        }

        if ($this->isConstantScalarExpression($node)) {
            $name = 'const-scalar-exprs';

            if (!isset($this->constSyntax[$name])) {
                $version = '5.6.0';

                $this->constSyntax[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->constSyntax[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    /**
     * @param Node $node
     * @return bool
     * @link https://github.com/llaville/php-compat-info/issues/140
     * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.const-scalar-exprs
     */
    protected function isConstantScalarExpression(Node $node): bool
    {
        foreach ($node->consts as $const) {
            if (!$const->value instanceof Node\Scalar) {
                return true;
            }
        }
        return false;
    }
}
