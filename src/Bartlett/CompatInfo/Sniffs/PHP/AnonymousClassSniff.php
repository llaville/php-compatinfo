<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Anonymous classes since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/anonymous_classes
 */
class AnonymousClassSniff extends SniffAbstract
{
    private $anonymousClass;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->anonymousClass = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->anonymousClass)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::ANONYMOUS_CLASS => $this->anonymousClass)
            );
        }
    }

    /**
     * @param Node $node
     * @return void
     */
    public function enterNode(Node $node): void
    {
        parent::enterNode($node);

        if ($this->isAnonymousClass($node)) {
            $name = '#';

            if (empty($this->anonymousClass)) {
                $version = '7.0.0alpha1';

                $this->anonymousClass[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'   => array()
                );
            }

            $this->anonymousClass[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isAnonymousClass(Node $node): bool
    {
        return ($node instanceof Node\Expr\New_
            && $node->class instanceof Node\Stmt\Class_
        );
    }
}
