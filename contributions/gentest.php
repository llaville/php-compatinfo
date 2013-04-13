<?php
/**
 * Skeleton generator
 *
 * The PHP_CompatInfo Skeleton Generator is a tool that can generate
 * skeleton phpunit tests/extensions from load modules

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
        "usage %s <extname>" . PHP_EOL,
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

$tplDir = dirname(__FILE__) . DIRECTORY_SEPARATOR;

try {
    $skeleton = $tplDir . 'test.skeleton.tpl';

    $tpl = new Text_Template($skeleton);

    /**
     * Cannot use directly setFile() method, due to issue
     * @link: https://github.com/sebastianbergmann/php-text-template/issues/7
     */
    //$tpl->setFile($skeleton);

    $vars = array(
        'extname'  => ucfirst($extname),
    );
    $tpl->setVar($vars);

    echo $tpl->render();

} catch (Exception $e) {
    die ($e->getMessage());
}
