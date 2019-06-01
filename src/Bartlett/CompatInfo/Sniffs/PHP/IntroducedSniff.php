<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\CompatInfo\Util\Database;
use Bartlett\CompatInfo\Collection\ReferenceCollection;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

use PDO;

class IntroducedSniff extends SniffAbstract
{
    use AbstractChange;

    private $introduced;
    private $references;

    public function setUpBeforeSniff()
    {
        parent::setUpBeforeSniff();

        /**
         * Initializes CompatInfo DB
         */
        $pdo = Database::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->references = new ReferenceCollection(array(), $pdo);

        $this->introduced = array();
        //xdebug_start_trace();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->introduced)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::INTRODUCED => $this->introduced)
            );
        }
        //xdebug_stop_trace();
    }

    public function enterNode(Node $node)
    {
        parent::enterNode($node);

        if ($this->isConditionalFunc($node)) {
            $this->condFunc = $this->getConditionalName($node);
        } else {
            $this->condFunc = null;
        }

        if ($this->isConditionalConst($node)) {
            $this->condConst = $this->getConditionalName($node);
        } else {
            $this->condConst = null;
        }
    }

    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        // Function call
        if ($this->isFuncCall($node)) {
        // Function
        } elseif ($this->isNewFunc($node)) {
        // Class instantiation call
        } elseif ($this->isClassCall($node)) {
        // Class, Interface, Trait
        } elseif ($this->isNewClass($node)) {
        // Constant
        } elseif ($this->isNewConst($node)) {
        }

        $this->condFunc  = null;
        $this->condConst = null;
    }

    protected function pushElement($name, $severity, $version, Node $node, $message = null)
    {
        if (!isset($this->introduced[$name])) {
            $this->introduced[$name] = array(
                'severity' => $severity,
                'version'  => $version,
                'spots'    => array()
            );
            if (null !== $message) {
                $this->introduced[$name]['message'] = $message;
            }
        }
        $this->introduced[$name]['spots'][] = $this->getCurrentSpot($node);
    }

    protected function isNewFunc(Node $node)
    {
        if (!$node instanceof Node\Stmt\Function_) {
            return false;
        }
        $name     = $node->name;
        $versions = $this->references->find('functions', $name);

        if ($versions['ext.name'] === 'user') {
            return true;
        }

        if (in_array($versions['ext.name'], array('Core', 'standard'))) {
            $message  = sprintf('Cannot redeclare function <info>%s()</info>', $name);
        } else {
            $message  = sprintf(
                'Cannot redeclare function <info>%s()</info> provided by extension <info>%s</info>',
                $name,
                $versions['ext.name']
            );
        }
        $version  = $versions['php.min'];
        $severity = $this->getCurrentSeverity($version, 'lt');

        $this->pushElement($name, $severity, $version, $node, $message);
        return false;
    }

    protected function isFuncCall(Node $node)
    {
        if ($node instanceof Node\Expr\FuncCall
            && $node->name instanceof Node\Name
            && !$this->isSameFunc($node->name, 'define')
        ) {
            // find reference info
            $name     = (string) $node->name;
            $argc     = isset($node->args) ? count($node->args) : 0;
            $versions = $this->references->find('functions', $name, $argc);

            if (!empty($versions['php.max'])) {
                // function is removed (proceeded by RemovedSniff)
                return false;
            }
            $message = null;

            if (!empty($versions['parameters'])) {
                // function used new parameter since its first signature
                if ($versions['php.min'] !== $versions['parameters'][0]) {
                    $message = sprintf(
                        'Function <info>%s()</info> has new parameter <info>#%d</info>',
                        $name,
                        count($versions['parameters']) - 1
                    );
                }
            }

            $version  = $versions['php.min'];
            $severity = $this->getCurrentSeverity($version);

            $this->pushElement($name, $severity, $version, $node, $message);
            return true;
        }
        return false;
    }

    protected function isNewClass(Node $node)
    {
        if (!$node instanceof Node\Stmt\ClassLike) {
            return false;
        }

        if ($node instanceof Node\Stmt\Class_) {
            $context = 'classes';
            $ctx     = substr($context, 0, -2);
        } elseif ($node instanceof Node\Stmt\Interface_) {
            $context = 'interfaces';
            $ctx     = substr($context, 0, -1);
        } else {
            $context = 'traits';
            $ctx     = substr($context, 0, -1);
        }
        $name     = $node->name;
        $versions = $this->references->find($context, $name);

        if ($versions['ext.name'] !== 'user') {
            $message  = sprintf(
                'Cannot redeclare %s <info>%s()</info> provided by extension <info>%s</info>',
                $ctx,
                $name,
                $versions['ext.name']
            );
            $version  = $versions['php.min'];
            $severity = $this->getCurrentSeverity($version, 'lt');

            $this->pushElement($name, $severity, $version, $node, $message);
            return false;
        }
        return true;
    }

    protected function isClassCall(Node $node)
    {
        if ($node instanceof Node\Expr\New_
            && $node->class instanceof Node\Name
        ) {
            // find reference info
            $name     = (string) $node->class;
            $versions = $this->references->find('classes', $name);
            $version  = $versions['php.min'];
            $message  = sprintf('Class <info>%s</info>', $name);
            $severity = $this->getCurrentSeverity($version);

            $this->pushElement($name, $severity, $version, $node, $message);
            return true;
        }
        return false;
    }

    protected function isNewConst(Node $node)
    {
        if ($node instanceof Node\Expr\FuncCall
            && $node->name instanceof Node\Name
            && $this->isSameFunc($node->name, 'define')
        ) {
            $name = $node->args[0]->value->value;

            $versions = $this->references->find('constants', $name);

            if ($versions['ext.name'] !== 'user' &&
                (is_null($this->condConst) || $name !== $this->condConst)
            ) {
                if (in_array($versions['ext.name'], array('Core', 'standard'))) {
                    $message  = sprintf('Constant <info>%s</info> already defined', $name);
                } else {
                    $message  = sprintf(
                        'Constant <info>%s</info> already defined, provided by extension <info>%s</info>',
                        $name,
                        $versions['ext.name']
                    );
                }
                $version  = $versions['php.min'];
                $severity = $this->getCurrentSeverity($version, 'lt', 'warning');

                $this->pushElement($name, $severity, $version, $node, $message);
                return true;
            }
        }
        return false;
    }
}
