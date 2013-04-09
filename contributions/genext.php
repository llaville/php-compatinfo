<?php
/**
 * Skeleton generator
 *
 * The PHP_CompatInfo Skeleton Generator is a tool that can generate
 * skeleton references/extensions from load modules

 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @author   Remi Collet <Remi@FamilleCollet.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     http://php5.laurent-laville.org/compatinfo/
 */

require_once 'Text/Template/Autoload.php';

if ($_SERVER['argc'] < 2) {
    // Help usage
    printf(
        "usage %s <extname> [<extversion>] [<defversion>]" . PHP_EOL,
        $_SERVER['argv'][0]
    );
    exit(1);
}

$extname = $_SERVER['argv'][1];

if (!($extname == 'internal' || $extname == 'Core' || extension_loaded($extname))) {
    // if dynamic extension load is activated
    $loaded = (bool) ini_get('enable_dl');
    if ($loaded) {
        // give a second chance
        $prefix = (PHP_SHLIB_SUFFIX === 'dll') ? 'php_' : '';
        $loaded = @dl($prefix . $extname . '.' . PHP_SHLIB_SUFFIX);
    }
    if ($loaded === false) {
        echo "Extension $extname not loaded" . PHP_EOL;
        exit(2);
    }
}

if ($extname == 'Core' && version_compare(PHP_VERSION,'5.3.0','<')) {
    $extname = 'internal';
}
if ($extname == 'internal' && version_compare(PHP_VERSION,'5.3.0','>=')) {
    $extname = 'Core';
}

$extversion = $_SERVER['argc'] > 2 ? $_SERVER['argv'][2] : '';
$defversion = $_SERVER['argc'] > 3 ? $_SERVER['argv'][3] : '4.0.0';

/**
 * Uses PHP API Reflection to retrieve informations (functions, constants, classes)
 */
$extension = new ReflectionExtension($extname);
$classes   = array_keys($extension->getClasses());
$functions = array_keys($extension->getFunctions());
$constants = array_keys($extension->getConstants());

$classItems = array();
foreach ($classes as $classname) {
    $classItems[] = "            "
        . sprintf("%-40s", "'$classname'")
        . "=> array('$defversion', ''),";
}

$functionItems = array();
foreach ($functions as $fctname) {
    $functionItems[] = "            "
        . sprintf("%-40s", "'$fctname'")
        . "=> array('$defversion', ''),";
}

$constantItems = array();
foreach ($constants as $cstname) {
    $constantItems[] = "            "
        . sprintf("%-40s", "'$cstname'")
        . "=> array('$defversion', ''),";
}

$tplDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;

try {
    $skeleton = $tplDir . 'reference.skeleton.tpl';

    $tpl = new Text_Template($skeleton);

    /**
     * Cannot use directly setFile() method, due to issue
     * @link: https://github.com/sebastianbergmann/php-text-template/issues/7
     */
    //$tpl->setFile($skeleton);

    $vars = array(
        'extname'    => $extname,
        'extversion' => $extversion,
        'defversion' => $defversion,
        'release'    => '2.x.y',
        'classes'    => implode(PHP_EOL, $classItems),
        'functions'  => implode(PHP_EOL, $functionItems),
        'constants'  => implode(PHP_EOL, $constantItems),
    );
    $tpl->setVar($vars);

    echo $tpl->render();

} catch (Exception $e) {
    die ($e->getMessage());
}
