<?php
require_once 'PEAR/PackageFileManager2.php';

PEAR::setErrorHandling(PEAR_ERROR_DIE);

$p2 = new PEAR_PackageFileManager2();

$name        = 'PHP_CompatInfo';
$summary     = 'Find out the minimum version and the extensions required for a piece of code to run';
$description = 'PHP_CompatInfo will parse a file/folder/array to find out the minimum
version and extensions required for it to run. CLI version has many reports
(extension, interface, class, function, constant) to display and ability to show
content of dictionary references.
';
//$channel     = 'pear.php.net';
$channel     = 'bartlett.laurent-laville.org';

$release_state   = 'stable';
//$release_version = '2.2.0snapshot' . date('Ymd');
$release_version = '2.2.1';

$api_state       = 'stable';
$api_version     = '2.2.0';
$release_notes   = "
Additions and changes:
- Version 2.2.0 support until PHP 5.3.9 and 5.4.0
- Version 2.2.1 support until PHP 5.3.10 and 5.4.0

Bug fixes:
- none
";
$license = array('BSD License', 'http://www.opensource.org/licenses/bsd-license.php');

$p2->setOptions(
    array(
        'packagedirectory'  => dirname(__FILE__),
        'baseinstalldir'    => 'Bartlett',
        'filelistgenerator' => 'file',
        'simpleoutput'      => true,
        'clearcontents'     => false,
        'changelogoldtonew' => false,
        'ignore'            => array(
            basename(__FILE__),
            '.git', '*.log',
            'Thumbs.db', 'packageBeta*.xml', 'packageRC*.xml',
            'HOWTO.txt', 'genext.php',
            'PEAR.php', 'netgrowl.php',
            'IssueTest2.php',
            'PackageTest.php',
            'source3651.php',
            'source7813.php',
            'source13873.php',
            ),
        'installexceptions' => array(
            'phpcompatinfo.xml.dist' => '',
            'scripts/phpci' => '',
            'scripts/phpci.bat' => '',
        ),
        'exceptions'        => array(
            'LICENSE' => 'doc',
            'phpunit.xml' => 'test',
            'phpcompatinfo.xml.dist' => 'cfg',
            'README.markdown' => 'doc',
            ),
    )
);

$p2->setPackage($name);
$p2->setChannel($channel);
//$p2->setUri($uri);
$p2->setSummary($summary);
$p2->setDescription($description);

$p2->setPackageType('php');
$p2->setReleaseVersion($release_version);
$p2->setReleaseStability($release_state);
$p2->setAPIVersion($api_version);
$p2->setAPIStability($api_state);
$p2->setNotes($release_notes);
$p2->setLicense($license[0], $license[1]);

$p2->setPhpDep('5.2.0');
$p2->setPearinstallerDep('1.9.0');

$p2->addPackageDepWithChannel('required',
                              'Base', 'components.ez.no', '1.8');
$p2->addPackageDepWithChannel('required',
                              'ConsoleTools', 'components.ez.no', '1.6.1');
$p2->addPackageDepWithChannel('required',
                              'Console_CommandLine', 'pear.php.net', '1.1.3');
$p2->addPackageDepWithChannel('required',
                              'PHP_Reflect', 'bartlett.laurent-laville.org', '1.2.0');
$p2->addPackageDepWithChannel('required',
                              'PHP_Timer', 'pear.phpunit.de', '1.0.0');

$p2->addPackageDepWithChannel('optional',
                              'Net_Growl', 'pear.php.net', '2.4.0');
$p2->addPackageDepWithChannel('optional',
                              'PHPUnit', 'pear.phpunit.de', '3.5.0');

$p2->addExtensionDep('required', 'dom');
$p2->addExtensionDep('required', 'libxml');
$p2->addExtensionDep('required', 'pcre');
$p2->addExtensionDep('required', 'spl');

$p2->addMaintainer('lead', 'farell', 'Laurent Laville', 'pear@laurent-laville.org');
$p2->addMaintainer('contributor', 'remicollet', 'Remi Collet', '');

$p2->addGlobalReplacement('package-info', '@package_version@', 'version');

$p2->addReplacement('PHP/CompatInfo/CLI.php', 'pear-config', '@cfg_dir@', 'cfg_dir');
$p2->addReplacement('scripts/phpci', 'pear-config', '@php_bin@', 'php_bin');
$p2->addReplacement('scripts/phpci.bat', 'pear-config', '@php_bin@', 'php_bin');
$p2->addReplacement('scripts/phpci.bat', 'pear-config', '@bin_dir@', 'bin_dir');

$p2->addWindowsEol('scripts/phpci.bat');
$p2->addUnixEol('scripts/phpci');

$p2->addRelease();
$p2->setOSInstallCondition('windows');
$p2->addInstallAs('scripts/phpci.bat', 'phpci.bat');
$p2->addInstallAs('scripts/phpci', 'phpci');
$p2->addRelease();
$p2->addInstallAs('scripts/phpci', 'phpci');
$p2->addIgnoreToRelease('scripts/phpci.bat', 'phpci.bat');

$p2->generateContents();

if (isset($_GET['make'])
    || (isset($_SERVER['argv']) && @$_SERVER['argv'][1] == 'make')) {
    $p2->writePackageFile();
} else {
    $p2->debugPackageFile();
}
