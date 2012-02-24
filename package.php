<?php
/**
 * Unified package script generator.
 *
 * Build PEAR package easily, quickly.
 * Its own package.ini file looks simple enough to edit and maintain.
 *
 * Credits to https://github.com/c9s/Onion
 *
 * PHP version 5
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD
 * @version  SVN: $Id:$
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'PEAR/PackageFileManager2.php';

/**
 * Generates installexceptions, or exceptions key pfm option
 *
 * @param mixed $rules File mapping role exception
 *
 * @return array
 */
function mappingExceptions($rules)
{
    $exceptions = array();
    foreach ($rules as $exception) {
        $rule = explode(',', $exception);

        if (count($rule)) {
            list($file, $role) = array_map('trim', $rule);
            $exceptions[$file] = $role;
        }
    }
    return $exceptions;
}

/**
 * Build list of a category of maintainer
 *
 * @param array  $authors Maintainers list
 * @param string $type    Maintainer category (lead, helper, contributor)
 * @param object $pfm     Instance of PEAR_PackageFileManager2
 *
 * @return void
 */
function addMaintainer($authors, $type, $pfm)
{
    // author info: {name}, {userid} [, {email} [, {inactive}]]
    foreach ($authors as $author) {
        $matches = explode(',', $author);
        if (count($matches) > 1) {
            $matches = array_map('trim', $matches);
            $active  = 'yes';
            if (isset($matches[3])) {
                $active = ($matches[3] === 'inactive') ? 'no' : $active;
            }
            $email = (isset($matches[2])) ? $matches[2] : '';
            $pfm->addMaintainer($type, $matches[1], $matches[0], $email, $active);
        }
    }
}

/**
 * Build list of packages and extensions dependencies
 *
 * @param array  $dependencies List of packages and extensions dependencies
 * @param string $type         'required' or 'optional' dependencies
 * @param object $pfm          Instance of PEAR_PackageFileManager2
 *
 * @return void
 */
function addDep($dependencies, $type, $pfm)
{
    $deps = array_keys($dependencies);

    foreach ($deps as $dep) {
        if (preg_match('/ext\/(.*)/', $dep, $matches)) {
            $pfm->addExtensionDep($type, $matches[1]);

        } elseif (preg_match('/(.*)\/(.*)/', $dep, $matches)) {
            $pfm->addPackageDepWithChannel(
                $type, $matches[2], $matches[1], $dependencies[$dep]
            );
        }
    }
}

/**
 * Adds OS EOL task on a files list
 *
 * @param mixed  $files List of file to apply OS EOL condition
 * @param string $os    Identify OS (windows or unix)
 * @param object $pfm   Instance of PEAR_PackageFileManager2
 *
 * @return void
 */
function addEol($files, $os, $pfm)
{
    if (!is_array($files)) {
        $files = array($files);
    }
    foreach ($files as $file) {
        if ('windows' == $os) {
            $pfm->addWindowsEol($file);
        } else {
            $pfm->addUnixEol($file);
        }
    }
}

/**
 * Adds install OS conditions
 *
 * @param mixed  $rules List of conditions to apply
 * @param string $os    Identify OS (windows or unix)
 * @param object $pfm   Instance of PEAR_PackageFileManager2
 *
 * @return void
 */
function addInstallCondition($rules, $os, $pfm)
{
    $pfm->addRelease();
    if ('windows' == $os) {
        $pfm->setOSInstallCondition('windows');
    }

    if (!is_array($rules)) {
        $rules = array($rules);
    }
    foreach ($rules as $rule) {
        $rule = explode(',', $rule);

        if (count($rule)) {
            list($path, $as) = array_map('trim', $rule);
            $pfm->addInstallAs($path, $as);
        }
    }
}

/**
 * Adds ignores OS conditions
 *
 * @param mixed  $rules List of conditions to apply
 * @param object $pfm   Instance of PEAR_PackageFileManager2
 *
 * @return void
 */
function addIgnoreCondition($rules, $pfm)
{
    if (!is_array($rules)) {
        $rules = array($rules);
    }
    foreach ($rules as $rule) {
        $rule = explode(',', $rule);

        if (count($rule)) {
            list($path, $as) = array_map('trim', $rule);
            $pfm->addIgnoreToRelease($path, $as);
        }
    }

}

$filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'package.ini';
if (!file_exists($filename)) {
    echo 'Configuration file "package.ini" does not exist';
    exit(1);
}

$ini = parse_ini_file($filename, true);

if ($ini === false) {
    echo 'Cannot parse configuration file "package.ini"';
    exit(1);
}

PEAR::setErrorHandling(PEAR_ERROR_DIE);

$pfm = new PEAR_PackageFileManager2();

// files to ignore
if (isset($ini['options']['ignores'])) {
    $ignores = (array)$ini['options']['ignores'];
} else {
    $ignores = array();
}
$ignores[] = basename(__FILE__);

// files mapping install exceptions
$installexceptions = array();
if (isset($ini['options']['installexceptions'])) {
    $installexceptions = mappingExceptions($ini['options']['installexceptions']);
}

// files mapping exceptions
$exceptions = array();
if (isset($ini['options']['exceptions'])) {
    $exceptions = mappingExceptions($ini['options']['exceptions']);
}

$options = array(
    'packagedirectory'  => dirname(__FILE__),
    'baseinstalldir'    => $ini['options']['baseinstalldir'],
    'filelistgenerator' => $ini['options']['filelistgenerator'],
    'simpleoutput'      => $ini['options']['simpleoutput'],
    'clearcontents'     => $ini['options']['clearcontents'],
    'changelogoldtonew' => $ini['options']['changelogoldtonew'],
    'ignore'            => $ignores,
    'installexceptions' => $installexceptions,
    'exceptions'        => $exceptions,
);
$pfm->setOptions($options);

$pfm->setPackage($ini['package']['name']);
$pfm->setChannel($ini['package']['channel']);
$pfm->setSummary($ini['package']['summary']);
$pfm->setDescription($ini['package']['desc']);

$pfm->setPackageType('php');
$pfm->setReleaseVersion($ini['package']['version']);
$pfm->setReleaseStability($ini['package']['stability.release']);
$pfm->setAPIVersion($ini['package']['version.api']);
$pfm->setAPIStability($ini['package']['stability.api']);
$pfm->setNotes($ini['package']['notes']);

// default license
$license = array('PHP', false);

if (isset($ini['package']['license'])) {
    // license info: {license} [, {uri}]
    $matches = explode(',', $ini['package']['license']);
    $match   = count($matches);
    if ($match > 0) {
        $matches = array_map('trim', $matches);
        if ($match == 1) {
            // without URI
            $license = array($matches[0], false);
        } else {
            // with URI
            $license = array($matches[0], $matches[1]);
        }
    }
}
$pfm->setLicense($license[0], $license[1]);

$pfm->setPhpDep($ini['require']['php']);
$pfm->setPearinstallerDep($ini['require']['pearinstaller']);

// required dependencies
if (isset($ini['require'])) {
    addDep($ini['require'], 'required', $pfm);
}

// optional dependencies
if (isset($ini['optional'])) {
    addDep($ini['optional'], 'optional', $pfm);
}

// lead
addMaintainer($ini['package']['authors'], 'lead', $pfm);

// helper
if (isset($ini['package']['helpers'])) {
    addMaintainer($ini['package']['helpers'], 'helper', $pfm);
}

// contributor
if (isset($ini['package']['contributors'])) {
    addMaintainer($ini['package']['contributors'], 'contributor', $pfm);
}

// replaces
if (isset($ini['replacements'])) {
    foreach ($ini['replacements'] as $file => $rules) {
        if (!is_array($rules)) {
            $rules = array($rules);
        }
        foreach ($rules as $rule) {
            $rule = explode(',', $rule);

            if (count($rule)) {
                list($type, $from, $to) = array_map('trim', $rule);
                if ($file === '*') {
                    $pfm->addGlobalReplacement($type, $from, $to);
                } else {
                    $pfm->addReplacement($file, $type, $from, $to);
                }
            }
        }
    }
}

// EOL
if (isset($ini['installConditions']['windowsEol'])) {
    addEol($ini['installConditions']['windowsEol'], 'windows', $pfm);
}
if (isset($ini['installConditions']['unixEol'])) {
    addEol($ini['installConditions']['unixEol'], 'unix', $pfm);
}

// OS install conditions
if (isset($ini['installConditions']['windows.installAs'])) {
    addInstallCondition(
        $ini['installConditions']['windows.installAs'], 'windows', $pfm
    );
}
if (isset($ini['installConditions']['windows.ignores'])) {
    addIgnoreCondition(
        $ini['installConditions']['windows.ignores'], $pfm
    );
}
if (isset($ini['installConditions']['other.installAs'])) {
    addInstallCondition(
        $ini['installConditions']['other.installAs'], 'other', $pfm
    );
}
if (isset($ini['installConditions']['other.ignores'])) {
    addIgnoreCondition(
        $ini['installConditions']['other.ignores'], $pfm
    );
}

// generates XML
$pfm->generateContents();

if (isset($_GET['make'])
    || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')
) {
    $pfm->writePackageFile();
} else {
    $pfm->debugPackageFile();
}
