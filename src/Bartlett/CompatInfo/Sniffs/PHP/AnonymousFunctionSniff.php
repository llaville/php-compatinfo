<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * $this in closure allowed since PHP 5.4
 * Anonymous function allowed since PHP 5.3
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/24 $this in closure
 * @link https://github.com/wimg/PHPCompatibility/issues/35 Anonymous function
 */
class AnonymousFunctionSniff extends SniffAbstract
{
    private $anonymousFunction;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->anonymousFunction = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->anonymousFunction)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::ANONYMOUS_FUNCTION => $this->anonymousFunction)
            );
        }
    }

    public function enterNode(Node $node): void
    {
        parent::enterNode($node);

        if (!$this->visitor->inContext('closure')) {
            return;
        }
        $name = '#';

        if (empty($this->anonymousFunction)) {
            $version = '5.3.0';

            $this->anonymousFunction[$name] = array(
                'severity' => $this->getCurrentSeverity($version),
                'version'  => $version,
                'spots'    => array()
            );
        }

        if ($node instanceof Node\Expr\Closure) {
            $this->anonymousFunction[$name]['spots'][] = $this->getCurrentSpot($node);
        }

        if ($node instanceof Node\Expr\ClassConstFetch
            && $node->class instanceof Node\Name
        ) {
            if (strcasecmp((string) $node->class, 'self') === 0
                || strcasecmp((string) $node->class, 'static') === 0
            ) {
                $name = strtolower((string) $node->class);
            }
        }

        if ($node instanceof Node\Expr\PropertyFetch) {
            if ($node->var instanceof Node\Expr\Variable
                && strcasecmp($node->var->name, 'this') === 0
            ) {
                $name = 'this';
            }
        }

        if (in_array($name, array('this', 'self', 'static'))) {
            // Use of $this | self | static inside a closure is allowed since 5.4.0

            if (!isset($this->anonymousFunction[$name])) {
                $version = '5.4.0';

                $this->anonymousFunction[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->anonymousFunction[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
