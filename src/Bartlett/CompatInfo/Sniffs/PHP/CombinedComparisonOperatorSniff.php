<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Combined Comparison (Spaceship) Operator since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/combined-comparison-operator
 */
class CombinedComparisonOperatorSniff extends SniffAbstract
{
    private $combinedComparisonOperator;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->combinedComparisonOperator = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->combinedComparisonOperator)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::COMBINED_COMPARISON_OPERATOR => $this->combinedComparisonOperator)
            );
        }
    }

    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if ($node instanceof Node\Expr\BinaryOp\Spaceship) {
            $name = '#';

            if (empty($this->combinedComparisonOperator)) {
                $version = '7.0.0alpha1';

                $this->combinedComparisonOperator[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }

            $this->combinedComparisonOperator[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
