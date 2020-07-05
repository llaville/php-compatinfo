<?php declare(strict_types=1);

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

/**
 * {Description}
 * The register_globals and register_long_arrays php.ini directives
 * have been removed.
 *
 * {Reference}
 * http://php.net/manual/en/migration54.incompatible.php
 */
class NoCompatRegisterGlobalsSniff extends SniffAbstract
{
    private $noCompat;

    public function setUpBeforeSniff()
    {
        parent::setUpBeforeSniff();

        $this->noCompat = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->noCompat)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::NO_COMPAT_REGISTER => $this->noCompat)
            );
        }
    }

    public function enterNode(Node $node)
    {
        if (!$this->hasRegisterLongArray($node)) {
            return;
        }

        $name     = '#';
        $version  = '5.4.0';
        $severity = $this->getCurrentSeverity($version, 'lt', 'warning');
        $message  = sprintf(
            'Ini directive register_long_arrays is removed, <info>$%s</info> no longer available',
            $node->name
        );

        if (!isset($this->noCompat[$name])) {
            $this->noCompat[$name] = array(
                'severity' => $severity,
                'version'  => $version,
                'message'  => $message,
                'spots'    => array()
            );
        }
        $this->noCompat[$name]['spots'][] = $this->getCurrentSpot($node);
    }

    protected function hasRegisterLongArray(Node $node)
    {
        return $node instanceof Node\Expr\Variable
            && is_string($node->name)
            && preg_match('/^HTTP_[a-zA-Z_]+?_VARS$/', $node->name)
        ;
    }
}
