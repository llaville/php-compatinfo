<?php
/**
 * Unit tests for PHP_CompatInfo package, functions parameters
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.2.0
 */

if (!defined('TEST_FILES_PATH')) {
    define(
        'TEST_FILES_PATH',
        dirname(__FILE__) . DIRECTORY_SEPARATOR .
        '_files' . DIRECTORY_SEPARATOR
    );
}

/**
 * Tests for the PHP_CompatInfo class, about functions parameters versions
 */
class PHP_CompatInfo_ParameterTest extends PHPUnit_Framework_TestCase
{
    protected $pci;

    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
    }

    /**
     * example with get_browser
     *
     * @link http://www.php.net/manual/en/function.get-browser.php
     */
    public function testGetBrowserDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-01d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }
    public function testGetBrowserOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-01o.php');

        $this->assertSame(
            array('4.3.2', ''), $this->pci->getVersions()
        );
    }

}
