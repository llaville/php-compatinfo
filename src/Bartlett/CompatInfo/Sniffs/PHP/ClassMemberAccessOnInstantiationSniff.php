<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * Class member access on instantiation (since PHP 5.4)
 *
 * @link https://github.com/wimg/PHPCompatibility/issues/53
 * @link https://github.com/llaville/php-compat-info/issues/154
 *       Class member access on instantiation
 * @link http://php.net/manual/en/migration54.new-features.php
 */
class ClassMemberAccessOnInstantiationSniff extends SniffAbstract
{
    private $classMemberAccessOnInstantiation;

    public function enterSniff()
    {
        parent::enterSniff();

        $this->classMemberAccessOnInstantiation = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->classMemberAccessOnInstantiation)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::CLASS_MEMBER_ACCESS_ON_INSTANTIATION => $this->classMemberAccessOnInstantiation)
            );
        }
    }

    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        if ($node instanceof Node\Expr\MethodCall
            && is_string($node->name)
        ) {
            $caller = $node->var;

            if (!$caller instanceof Node\Expr\New_) {
                return;
            }

            $name = '#';

            if (empty($this->classMemberAccessOnInstantiation)) {
                $version = '5.4.0';

                $this->classMemberAccessOnInstantiation[$name] = array(
                    'severity' => $this->getCurrentSeverity($version),
                    'version'  => $version,
                    'spots'    => array()
                );
            }
            $this->classMemberAccessOnInstantiation[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }
}
