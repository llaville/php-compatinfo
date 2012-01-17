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

$release_state   = 'snapshot';
$release_version = '2.2.0snapshot' . date('Ymd');
//$release_version = '2.2.0';

$api_state       = 'beta';
$api_version     = '2.2.0';
$release_notes   = "
Additions and changes:
- fix references for functions with parameters that have different versions
- add detection for class member access on instantiation (e.g. (new Foo)->bar())
- improves detection for function with version changed depending of signature (arguments)
- add PHPUnit configuration file (phpunit.xml). Help for CI env integration
- split Issues Tests in two classes depending of code licences
- fix references for PHP 5.4.0
- make doc generation with AsciiDoc compatible with older version 8.4.5 (especially for old linux distributions)
- phing build documentation script is now easily reuseable (configuration through an external properties file)
- removes experimental PEAR package detection

Bug fixes:
- request #13094 : PHP5 method chaining ( http://pear.php.net/bugs/bug.php?id=13094 )
- fix version stamp in XML report
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
        'ignore'            => array(basename(__FILE__),
            '.git', '*.log',
            'Thumbs.db', 'packageBeta*.xml', 'packageRC*.xml',
            'HOWTO.txt', 'IssueTest2.php', 'genext.php',
            'PEAR.php', 'netgrowl.php'
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
                              'PHP_Reflect', 'bartlett.laurent-laville.org', '1.0.0');
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
