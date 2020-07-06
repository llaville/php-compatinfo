<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Use of Elvis syntax (middle portion of ternary operator missing) since PHP 5.3
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/49
 */
class ShortTernaryOperatorSyntaxSniff extends SniffAbstract
{
    private $shortTernaryOperatorSyntax;

    public function enterSniff(): void
    {
        parent::enterSniff();
        $this->shortTernaryOperatorSyntax = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->shortTernaryOperatorSyntax)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::SHORT_TERNARY_OPERATOR_SYNTAX => $this->shortTernaryOperatorSyntax)
            );
        }
    }

    public function leaveNode(Node $node): void
    {
        parent::leaveNode($node);

        if (!$node instanceof Node\Expr\Ternary) {
            return;
        }

        if ($node->if === null) {
            $name = '#';

            if (empty($this->shortTernaryOperatorSyntax)) {
                $version = '5.3.0';

                $this->shortTernaryOperatorSyntax[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->shortTernaryOperatorSyntax[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
