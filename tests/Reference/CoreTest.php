<?php
/**
 */

require_once 'GenericTest.php';

/**
 * Tests for the PHP_CompatInfo class, retrieving functions informations.
 *
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Remi Collet <Remi@FamilleCollet.com>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    Release: @package_version@
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 2.0.0RC4
 */
class PHP_CompatInfo_Reference_CoreTest extends PHP_CompatInfo_Reference_GenericTest
{
    /**
     * @covers PHP_CompatInfo_Reference_Core::getExtensions
     * @covers PHP_CompatInfo_Reference_Core::getFunctions
     * @covers PHP_CompatInfo_Reference_Core::getClasses
     * @covers PHP_CompatInfo_Reference_Core::getInterfaces
     */
    protected function setUp()
    {
        $this->optionnalconstants = array(
            // Not real constant
            '__CLASS__',
            '__FILE__',
            '__FUNCTION__',
            '__LINE__',
            '__COMPILER_HALT_OFFSET__',
            '__DIR__',
            '__METHOD__',
            '__NAMESPACE__',
        );
        if (DIRECTORY_SEPARATOR == '/') {
            $this->optionnalconstants = array_merge(
                $this->optionnalconstants,
                array(
                    // Win32 Only
                    'PHP_WINDOWS_VERSION_MAJOR',
                    'PHP_WINDOWS_VERSION_MINOR',
                    'PHP_WINDOWS_VERSION_BUILD',
                    'PHP_WINDOWS_VERSION_PLATFORM',
                    'PHP_WINDOWS_VERSION_SP_MAJOR',
                    'PHP_WINDOWS_VERSION_SP_MINOR',
                    'PHP_WINDOWS_VERSION_SUITEMASK',
                    'PHP_WINDOWS_VERSION_PRODUCTTYPE',
                    'PHP_WINDOWS_NT_DOMAIN_CONTROLLER',
                    'PHP_WINDOWS_NT_SERVER',
                    'PHP_WINDOWS_NT_WORKSTATION',
                )
            );
        } else {
            $this->optionnalconstants = array_merge(
                $this->optionnalconstants,
                array(
                    // Non Windows only
                    'PHP_MANDIR',
                )
            );
        }

        $this->optionnalfunctions = array(
            // Requires ZTS
            'zend_thread_id',
        );
        $this->obj = new PHP_CompatInfo_Reference_Core();
        $this->ref = $this->obj->getAll();

        if (version_compare(PHP_VERSION,'5.3.0') < 0) {
            // this is a hack...
            $this->ref['extensions']['internal'] = $this->ref['extensions']['Core'];
            unset($this->ref['extensions']['Core']);
        }
    }

    public function testGetFunctionsFromExtension() {
        if (version_compare(PHP_VERSION,'5.3.0') < 0) {
            $this->markTestSkipped(
              "Can't be tested in php " . PHP_VERSION
            );
        } else {
            parent::testGetFunctionsFromExtension();
        }
    }
}
