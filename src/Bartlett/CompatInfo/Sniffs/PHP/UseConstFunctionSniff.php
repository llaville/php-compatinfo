<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Use const, use function are PHP 5.6 or greater
 *
 * @link https://github.com/llaville/php-compat-info/issues/143
 * @link http://php.net/manual/en/migration56.new-features.php#migration56.new-features.use
 */
class UseConstFunctionSniff extends SniffAbstract
{
    private $useConstFunction;

    public function enterSniff(): void
    {
        parent::enterSniff();

        $this->useConstFunction = array();
    }

    public function leaveSniff(): void
    {
        parent::leaveSniff();

        if (!empty($this->useConstFunction)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::USE_CONST_FUNCTION => $this->useConstFunction)
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

        if ($this->isUseConstFunction($node)) {
            $name = '#';

            if (empty($this->useConstFunction)) {
                $version = '5.6.0';

                $this->useConstFunction[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }

            $this->useConstFunction[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function isUseConstFunction(Node $node): bool
    {
        return ($node instanceof Node\Stmt\Use_
            && in_array(
                $node->type,
                array(Node\Stmt\Use_::TYPE_FUNCTION, Node\Stmt\Use_::TYPE_CONSTANT)
            )
        );
    }
}
