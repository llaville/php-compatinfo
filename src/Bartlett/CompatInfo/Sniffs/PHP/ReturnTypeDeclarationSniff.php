<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Return Type Declarations since PHP 7.0.0 alpha1
 *
 * @link https://wiki.php.net/rfc/return_types
 */
class ReturnTypeDeclarationSniff extends SniffAbstract
{
    private $returnTypeDeclaration;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->returnTypeDeclaration = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->returnTypeDeclaration)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::RETURN_TYPE_DECLARATION => $this->returnTypeDeclaration)
            );
        }
    }

    /**
     * @return void
     */
    public function enterNode(Node $node): void
    {
        parent::enterNode($node);

        if ($this->hasReturnType($node)) {
            $name = '#';

            if (empty($this->returnTypeDeclaration)) {
                $version = '7.0.0alpha1';

                $this->returnTypeDeclaration[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }

            $this->returnTypeDeclaration[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function hasReturnType(Node $node): bool
    {
        if ($node instanceof Node\Stmt\ClassMethod
            || $node instanceof Node\Stmt\Function_
            || $node instanceof Node\Expr\Closure
        ) {
            return (null !== $node->returnType);
        }
        return false;
    }
}
