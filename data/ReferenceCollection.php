<?php
/**
 * Helper for script that handle compatinfo.sqlite file.
 *
 * CAUTION: uses at your own risk.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php BSD License
 * @since    Release 4.0.0alpha3
 */

class ReferenceCollection
{
    private $dbal;
    private $stmtExtensions;
    private $stmtReleases;
    private $stmtRelease;
    private $stmtIniEntries;
    private $stmtIniEntry;
    private $stmtClasses;
    private $stmtClass;
    private $stmtInterfaces;
    private $stmtInterface;
    private $stmtMethods;
    private $stmtMethod;
    private $stmtFunctions;
    private $stmtFunction;
    private $stmtConstants;
    private $stmtConstant;
    private $stmtClassConstant;
    private $stmtClassConst;
    private $initialized;

    public function __construct(\PDO $pdo)
    {
        $this->dbal = $pdo;
        $this->dbal->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        if (!$this->initialized) {
            $this->doInitialize();
            $this->initialized = true;
        }
    }

    public function addExtension($rec)
    {
        $this->changedElements('stmtExtensions', $rec);
    }

    public function addRelease($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'rel_version' => $rec['rel_version'],
        );
        $this->stmtRelease->execute($criteria);
        $row = $this->stmtRelease->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtReleases', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtReleases', $rec);
            return 1;
        }
    }

    public function addIniEntry($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'name'        => $rec['name'],
        );
        $this->stmtIniEntry->execute($criteria);
        $row = $this->stmtIniEntry->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtIniEntries', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtIniEntries', $rec);
            return 1;
        }
    }

    public function addClass($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'name'        => $rec['name'],
        );
        $this->stmtClass->execute($criteria);
        $row = $this->stmtClass->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtClasses', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtClasses', $rec);
            return 1;
        }
    }

    public function addInterface($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'name'        => $rec['name'],
        );
        $this->stmtInterface->execute($criteria);
        $row = $this->stmtInterface->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtInterfaces', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtInterfaces', $rec);
            return 1;
        }
    }

    public function addMethod($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'class_name'  => $rec['class_name'],
            'name'        => $rec['name'],
        );
        $this->stmtMethod->execute($criteria);
        $row = $this->stmtMethod->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtMethods', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtMethods', $rec);
            return 1;
        }
    }

    public function addClassConstant($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'class_name'  => $rec['class_name'],
            'name'        => $rec['name'],
        );
        $this->stmtClassConst->execute($criteria);
        $row = $this->stmtClassConst->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtClassConstant', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtClassConstant', $rec);
            return 1;
        }
    }

    public function addFunction($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'name'        => $rec['name'],
        );
        $this->stmtFunction->execute($criteria);
        $row = $this->stmtFunction->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtFunctions', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtFunctions', $rec);
            return 1;
        }
    }

    public function addConstant($rec)
    {
        $criteria = array(
            'ext_name_fk' => $rec['ext_name_fk'],
            'name'        => $rec['name'],
        );
        $this->stmtConstant->execute($criteria);
        $row = $this->stmtConstant->fetch(\PDO::FETCH_ASSOC);

        if (is_array($row)) {
            if ($row == $rec) {
                // nothing to do
                return 0;
            }
            // update applied
            $this->changedElements('stmtConstants', $rec);
            return -1;
        } else {
            // not yet exist
            $this->changedElements('stmtConstants', $rec);
            return 1;
        }
    }

    protected function doInitialize()
    {
        $tblExtensions = 'bartlett_compatinfo_extensions';
        $tblReleases   = 'bartlett_compatinfo_releases';
        $tblIniEntries = 'bartlett_compatinfo_inientries';
        $tblClasses    = 'bartlett_compatinfo_classes';
        $tblInterfaces = 'bartlett_compatinfo_interfaces';
        $tblMethods    = 'bartlett_compatinfo_methods';
        $tblFunctions  = 'bartlett_compatinfo_functions';
        $tblConstants  = 'bartlett_compatinfo_constants';
        $tblClassConst = 'bartlett_compatinfo_const';

        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblExtensions .
            ' (id INTEGER, name VARCHAR(32),' .
            ' PRIMARY KEY (id))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblReleases .
            ' (ext_name_fk INTEGER, rel_version VARCHAR(8), rel_date DATE, rel_state VARCHAR(8),' .
            ' ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, rel_version))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblIniEntries .
            ' (ext_name_fk INTEGER, name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblClasses .
            ' (ext_name_fk INTEGER, name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblInterfaces .
            ' (ext_name_fk INTEGER, name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblMethods .
            ' (ext_name_fk INTEGER, class_name VARCHAR(32), name VARCHAR(32),' .
            ' static INTEGER,'.
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, class_name, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblFunctions .
            ' (ext_name_fk INTEGER, name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' parameters VARCHAR(255), php_excludes VARCHAR(255), ' .
            ' PRIMARY KEY (ext_name_fk, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblConstants .
            ' (ext_name_fk INTEGER, name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' php_excludes VARCHAR(255), ' .
            ' PRIMARY KEY (ext_name_fk, name))'
        );
        $this->dbal->exec(
            'CREATE TABLE IF NOT EXISTS ' . $tblClassConst .
            ' (ext_name_fk INTEGER, class_name VARCHAR(32), name VARCHAR(32),' .
            ' ext_min VARCHAR(16), ext_max VARCHAR(16),' .
            ' php_min VARCHAR(16), php_max VARCHAR(16),' .
            ' PRIMARY KEY (ext_name_fk, class_name, name))'
        );
        $this->stmtExtensions = $this->dbal->prepare(
            'INSERT INTO ' . $tblExtensions .
            ' (id, name)' .
            ' VALUES (:id, :name)'
        );
        $this->stmtReleases = $this->dbal->prepare(
            'REPLACE INTO ' . $tblReleases .
            ' (ext_name_fk, rel_version, rel_date, rel_state, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :rel_version, :rel_date, :rel_state, :ext_max, :php_min, :php_max)'
        );
        $this->stmtIniEntries = $this->dbal->prepare(
            'REPLACE INTO ' . $tblIniEntries .
            ' (ext_name_fk, name, ext_min, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :name, :ext_min, :ext_max, :php_min, :php_max)'
        );
        $this->stmtClasses = $this->dbal->prepare(
            'REPLACE INTO ' . $tblClasses .
            ' (ext_name_fk, name, ext_min, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :name, :ext_min, :ext_max, :php_min, :php_max)'
        );
        $this->stmtInterfaces = $this->dbal->prepare(
            'REPLACE INTO ' . $tblInterfaces .
            ' (ext_name_fk, name, ext_min, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :name, :ext_min, :ext_max, :php_min, :php_max)'
        );
        $this->stmtMethods = $this->dbal->prepare(
            'REPLACE INTO ' . $tblMethods .
            ' (ext_name_fk, class_name, name, static, ext_min, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :class_name, :name, :static, :ext_min, :ext_max, :php_min, :php_max)'
        );
        $this->stmtFunctions = $this->dbal->prepare(
            'REPLACE INTO ' . $tblFunctions .
            ' (ext_name_fk, name, ext_min, ext_max, php_min, php_max, parameters, php_excludes)' .
            ' VALUES (:ext_name_fk, :name, :ext_min, :ext_max, :php_min, :php_max, :parameters, :php_excludes)'
        );
        $this->stmtConstants = $this->dbal->prepare(
            'REPLACE INTO ' . $tblConstants .
            ' (ext_name_fk, name, ext_min, ext_max, php_min, php_max, php_excludes)' .
            ' VALUES (:ext_name_fk, :name, :ext_min, :ext_max, :php_min, :php_max, :php_excludes)'
        );
        $this->stmtClassConstant = $this->dbal->prepare(
            'REPLACE INTO ' . $tblClassConst .
            ' (ext_name_fk, class_name, name, ext_min, ext_max, php_min, php_max)' .
            ' VALUES (:ext_name_fk, :class_name, :name, :ext_min, :ext_max, :php_min, :php_max)'
        );

        $this->stmtRelease = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, rel_version, rel_date, rel_state, ext_max, php_min, php_max' .
            ' FROM ' . $tblReleases .
            ' WHERE ext_name_fk = :ext_name_fk AND rel_version = :rel_version COLLATE NOCASE'
        );
        $this->stmtIniEntry = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, name, ext_min, ext_max, php_min, php_max' .
            ' FROM ' . $tblIniEntries .
            ' WHERE ext_name_fk = :ext_name_fk AND name = :name COLLATE NOCASE'
        );
        $this->stmtClass = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, name, ext_min, ext_max, php_min, php_max' .
            ' FROM ' . $tblClasses .
            ' WHERE ext_name_fk = :ext_name_fk AND name = :name COLLATE NOCASE'
        );
        $this->stmtInterface = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, name, ext_min, ext_max, php_min, php_max' .
            ' FROM ' . $tblInterfaces .
            ' WHERE ext_name_fk = :ext_name_fk AND name = :name COLLATE NOCASE'
        );
        $this->stmtMethod = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, class_name, name, static, ext_min, ext_max, php_min, php_max' .
            ' FROM ' . $tblMethods .
            ' WHERE ext_name_fk = :ext_name_fk AND class_name = :class_name AND name = :name COLLATE NOCASE'
        );
        $this->stmtClassConst = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, class_name, name, ext_min, ext_max, php_min, php_max' .
            ' FROM ' . $tblClassConst .
            ' WHERE ext_name_fk = :ext_name_fk AND class_name = :class_name AND name = :name COLLATE NOCASE'
        );
        $this->stmtFunction = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, name, ext_min, ext_max, php_min, php_max, parameters, php_excludes' .
            ' FROM ' . $tblFunctions .
            ' WHERE ext_name_fk = :ext_name_fk AND name = :name COLLATE NOCASE'
        );
        $this->stmtConstant = $this->dbal->prepare(
            'SELECT' .
            ' ext_name_fk, name, ext_min, ext_max, php_min, php_max, php_excludes' .
            ' FROM ' . $tblConstants .
            ' WHERE ext_name_fk = :ext_name_fk AND name = :name COLLATE NOCASE'
        );
    }

    private function changedElements($type, $rec)
    {
        if (!property_exists($this, $type)) {
            return;
        }

        try {
            $this->{$type}->execute($rec);
        }
        catch (\Exception $e) {
            error_log(
                "PDO HANDLER LOG EXCEPTION ($type): " .
                $e->getMessage() . PHP_EOL .
                var_export($rec, true)
            );
            throw $e;
        }
    }
}
