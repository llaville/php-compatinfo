<?php

namespace Bartlett\CompatInfo\Sniffs\PHP;

use Bartlett\CompatInfo\Util\Database;

use Bartlett\Reflect\Sniffer\SniffAbstract;

use PhpParser\Node;

use PDO;

use Doctrine\Common\Collections\ArrayCollection;

class RemovedSniff extends SniffAbstract
{
    private $removed;

    // database abstraction layer
    private $dbal;

    private $stmtIniEntries;
    private $stmtFunctions;
    private $stmtConstants;

    private $references;

    public function setUpBeforeSniff()
    {
        parent::setUpBeforeSniff();

        /**
         * Initializes CompatInfo DB
         */
        $pdo = Database::initRefDb();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->doInitialize($pdo);

        $references = array();

        foreach (array('iniEntries', 'functions', 'constants') as $group) {
            $stmt = 'stmt' . ucfirst($group);
            $this->$stmt->execute();

            while ($row = $this->$stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $row['name'];
                unset($row['name']);
                $references[$name] = $row;
            }
        }

        $this->references = new ArrayCollection($references);

        $this->removed = array();
    }

    public function leaveSniff()
    {
        parent::leaveSniff();

        if (!empty($this->removed)) {
            // inform analyser that few sniffs were found
            $this->visitor->setMetrics(
                array(Metrics::REMOVED => $this->removed)
            );
        }
    }

    public function leaveNode(Node $node)
    {
        parent::leaveNode($node);

        if ($this->isRemovedFunc($node)) {
            $name = (string) $node->name;

            if (!isset($this->removed[$name])) {
                $versions = $this->references->get($name);
                $version  = $this->getRemovedVersion($versions['php.max']);
                $message  = sprintf('Call to undefined function <info>%s()</info>', $name);

                $this->removed[$name] = array(
                    'severity' => $this->getCurrentSeverity($version, 'lt'),
                    'version'  => $version,
                    'message'  => $message,
                    'spots'    => array()
                );
            }
            $this->removed[$name]['spots'][] = $this->getCurrentSpot($node);

        } elseif ($this->isRemovedConst($node)) {
            $name = (string) $node->name;

            if (!isset($this->removed[$name])) {
                $versions = $this->references->get($name);
                $version  = $this->getRemovedVersion($versions['php.max']);
                $message  = sprintf('Call to undefined constant <info>%s</info>', $name);

                $this->removed[$name] = array(
                    'severity' => $this->getCurrentSeverity($version, 'lt', 'warning'),
                    'version'  => $version,
                    'message'  => $message,
                    'spots'    => array()
                );
            }
            $this->removed[$name]['spots'][] = $this->getCurrentSpot($node);
        }
    }

    protected function getRemovedVersion($max)
    {
        if (version_compare($max, '5.3', 'lt')) {
            $version = '5.3.0';

        } elseif (version_compare($max, '5.4', 'lt')) {
            $version = '5.4.0';

        } elseif (version_compare($max, '5.5', 'lt')) {
            $version = '5.5.0';

        } elseif (version_compare($max, '5.6', 'lt')) {
            $version = '5.6.0';

        } elseif (version_compare($max, '7.0', 'lt')) {
            $version = '7.0.0';
        }
        return $version;
    }

    protected function isRemovedFunc(Node $node)
    {
        return ($node instanceof Node\Expr\FuncCall
            && $node->name instanceof Node\Name
            && $this->references->containsKey((string) $node->name)
        );
    }

    protected function isRemovedConst(Node $node)
    {
        return ($node instanceof Node\Expr\ConstFetch
            && $node->name instanceof Node\Name
            && $this->references->containsKey((string) $node->name)
        );
    }

    /**
     * Initializes DB statements
     *
     * @return void
     */
    protected function doInitialize(PDO $pdo)
    {
        $this->stmtIniEntries = $pdo->prepare(
            'SELECT i.name,' .
            ' ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' deprecated' .
            ' FROM bartlett_compatinfo_inientries i,  bartlett_compatinfo_extensions e' .
            ' WHERE i.ext_name_fk = e.id AND i.php_max <> ""'
        );

        $this->stmtFunctions = $pdo->prepare(
            'SELECT f.name,'.
            ' e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' parameters, php_excludes as "php.excludes",' .
            ' deprecated' .
            ' FROM bartlett_compatinfo_functions f,  bartlett_compatinfo_extensions e' .
            ' WHERE f.ext_name_fk = e.id AND f.php_max <> ""'
        );

        $this->stmtConstants = $pdo->prepare(
            'SELECT c.name,'.
            ' e.name as "ext.name", ext_min as "ext.min", ext_max as "ext.max",' .
            ' php_min as "php.min", php_max as "php.max",' .
            ' php_excludes as "php.excludes"' .
            ' FROM bartlett_compatinfo_constants c,  bartlett_compatinfo_extensions e' .
            ' WHERE c.ext_name_fk = e.id AND c.php_max <> ""'
        );

    }
}
