<?php
/**
 * Unit tests for PHP_CompatInfo package, functions parameters
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
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

    /**
     * Sets up the fixture.
     *
     * Parse source code to detect different signature versions
     *
     * @return void
     */
    protected function setUp()
    {
        $options = array(
            'cacheDriver' => 'null',
        );

        $this->pci = new PHP_CompatInfo($options);
    }

    /**
     * signature example with get_browser()
     *
     * @link http://www.php.net/manual/en/function.get-browser.php
     * @return void
     */
    public function testGetBrowserDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-01d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative signature example with get_browser()
     *
     * @link http://www.php.net/manual/en/function.get-browser.php
     * @return void
     */
    public function testGetBrowserOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-01o.php');

        $this->assertSame(
            array('4.3.2', ''), $this->pci->getVersions()
        );
    }

    /**
     * signature example with sha1()
     *
     * @link http://www.php.net/manual/en/function.sha1.php
     * @return void
     */
    public function testSha1DefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-02d.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative signature example with sha1()
     *
     * @link http://www.php.net/manual/en/function.sha1.php
     * @return void
     */
    public function testSha1OptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-02o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * signature example with sha1_file()
     *
     * @link http://www.php.net/manual/en/function.sha1_file.php
     * @return void
     */
    public function testSha1FileDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-03d.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative signature example with sha1_file()
     *
     * @link http://www.php.net/manual/en/function.sha1_file.php
     * @return void
     */
    public function testSha1FileOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-03o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * signature example with md5()
     *
     * @link http://www.php.net/manual/en/function.md5.php
     * @return void
     */
    public function testMd5DefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-04d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative signature example with md5()
     *
     * @link http://www.php.net/manual/en/function.md5.php
     * @return void
     */
    public function testMd5OptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-04o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with md5_file()
     *
     * @link http://www.php.net/manual/en/function.md5-file.php
     * @return void
     */
    public function testMd5FileDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-05d.php');

        $this->assertSame(
            array('4.2.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with md5_file()
     *
     * @link http://www.php.net/manual/en/function.md5-file.php
     * @return void
     */
    public function testMd5FileOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-05o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with mkdir()
     *
     * @link http://www.php.net/manual/en/function.mkdir.php
     * @return void
     */
    public function testMkdirDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-06d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with mkdir()
     *
     * @link http://www.php.net/manual/en/function.mkdir.php
     * @return void
     */
    public function testMkdirOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-06o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with file()
     *
     * @link http://www.php.net/manual/en/function.file.php
     * @return void
     */
    public function testFileDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-07d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with file()
     *
     * @link http://www.php.net/manual/en/function.file.php
     * @return void
     */
    public function testFileOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-07o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with str_replace()
     *
     * @link http://www.php.net/manual/en/function.str-replace.php
     * @return void
     */
    public function testStrReplaceDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-08d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with str_replace()
     *
     * @link http://www.php.net/manual/en/function.str-replace.php
     * @return void
     */
    public function testStrReplaceOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-08o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with fgetss()
     *
     * @link http://www.php.net/manual/en/function.fgetss.php
     * @return void
     */
    public function testFgetssDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-09d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with fgetss()
     *
     * @link http://www.php.net/manual/en/function.fgetss.php
     * @return void
     */
    public function testFgetssOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-09o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );

    }

    /**
     * example with microtime()
     *
     * @link http://www.php.net/manual/en/function.microtime.php
     * @return void
     */
    public function testMicrotimeDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-10d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with microtime()
     *
     * @link http://www.php.net/manual/en/function.microtime.php
     * @return void
     */
    public function testMicrotimeOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-10o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with array_keys()
     *
     * @link http://www.php.net/manual/en/function.array-keys.php
     * @return void
     */
    public function testArrayKeysDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-11d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with array_keys()
     *
     * @link http://www.php.net/manual/en/function.array-keys.php
     * @return void
     */
    public function testArrayKeysOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-11o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with array_slice()
     *
     * @link http://www.php.net/manual/en/function.array-slice.php
     * @return void
     */
    public function testArraySliceDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-12d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with array_slice()
     *
     * @link http://www.php.net/manual/en/function.array-slice.php
     * @return void
     */
    public function testArraySliceOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-12o.php');

        $this->assertSame(
            array('5.0.2', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with file_get_contents()
     *
     * @link http://www.php.net/manual/en/function.file-get-contents.php
     * @return void
     */
    public function testFileGetContentsDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-13d.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with file_get_contents()
     *
     * @link http://www.php.net/manual/en/function.file-get-contents.php
     * @return void
     */
    public function testFileGetContentsOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-13o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with stream_get_contents()
     *
     * @link http://www.php.net/manual/en/function.stream-get-contents.php
     * @return void
     */
    public function testStreamGetContentsDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-14d.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with stream_get_contents()
     *
     * @link http://www.php.net/manual/en/function.stream-get-contents.php
     * @return void
     */
    public function testStreamGetContentsOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-14o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with gettimeofday()
     *
     * @link http://www.php.net/manual/en/function.gettimeofday.php
     * @return void
     */
    public function testGettimeofdayDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-15d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with gettimeofday()
     *
     * @link http://www.php.net/manual/en/function.gettimeofday.php
     * @return void
     */
    public function testGettimeofdayOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-15o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with substr_count()
     *
     * @link http://www.php.net/manual/en/function.substr-count.php
     * @return void
     */
    public function testSubstrCountDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-16d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with substr_count()
     *
     * @link http://www.php.net/manual/en/function.substr-count.php
     * @return void
     */
    public function testSubstrCountOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-16o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with is_a()
     *
     * @link http://www.php.net/manual/en/function.is-a.php
     * @return void
     */
    public function testIsADefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-17d.php');

        $this->assertSame(
            array('4.2.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with is_a()
     *
     * @link http://www.php.net/manual/en/function.is-a.php
     * @return void
     */
    public function testIsAOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-17o.php');

        $this->assertSame(
            array('5.3.9', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with jdtojewish()
     *
     * @link http://www.php.net/manual/en/function.jdtojewish.php
     * @return void
     */
    public function testJdtojewishDefaultSignature()
    {
        if (!extension_loaded('calendar')) {
            $this->markTestSkipped(
                "The 'calendar' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-18d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with jdtojewish()
     *
     * @link http://www.php.net/manual/en/function.jdtojewish.php
     * @return void
     */
    public function testJdtojewishOptionalSignature()
    {
        if (!extension_loaded('calendar')) {
            $this->markTestSkipped(
                "The 'calendar' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-18o.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with stream_copy_to_stream()
     *
     * @link http://www.php.net/manual/en/function.stream-copy-to-stream.php
     * @return void
     */
    public function testStreamCopyToStreamDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-19d.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with stream_copy_to_stream()
     *
     * @link http://www.php.net/manual/en/function.stream-copy-to-stream.php
     * @return void
     */
    public function testStreamCopyToStreamOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-19o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with copy()
     *
     * @link http://www.php.net/manual/en/function.copy.php
     * @return void
     */
    public function testCopyDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-20d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with copy()
     *
     * @link http://www.php.net/manual/en/function.copy.php
     * @return void
     */
    public function testCopyOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-20o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with parse_url()
     *
     * @link http://www.php.net/manual/en/function.parse-url.php
     * @return void
     */
    public function testParseUrlDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-21d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with parse_url()
     *
     * @link http://www.php.net/manual/en/function.parse-url.php
     * @return void
     */
    public function testParseUrlOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-21o.php');

        $this->assertSame(
            array('5.2.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with memory_get_usage()
     *
     * @link http://www.php.net/manual/en/function.memory-get-usage.php
     * @return void
     */
    public function testMemoryGetUsageDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-22d.php');

        $this->assertSame(
            array('4.3.2', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with memory_get_usage()
     *
     * @link http://www.php.net/manual/en/function.memory-get-usage.php
     * @return void
     */
    public function testMemoryGetUsageOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-22o.php');

        $this->assertSame(
            array('5.2.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with htmlspecialchars()
     *
     * @link http://www.php.net/manual/en/function.htmlspecialchars.php
     * @return void
     */
    public function testHtmlspecialcharsDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-23d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with htmlspecialchars()
     *
     * @link http://www.php.net/manual/en/function.htmlspecialchars.php
     * @return void
     */
    public function testHtmlspecialcharsOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-23o.php');

        $this->assertSame(
            array('4.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with htmlentities()
     *
     * @link http://www.php.net/manual/en/function.htmlentities.php
     * @return void
     */
    public function testHtmlentitiesDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-24d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with htmlentities()
     *
     * @link http://www.php.net/manual/en/function.htmlentities.php
     * @return void
     */
    public function testHtmlentitiesOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-24o.php');

        $this->assertSame(
            array('4.0.3', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with nl2br()
     *
     * @link http://www.php.net/manual/en/function.nl2br.php
     * @return void
     */
    public function testNl2brDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-25d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with nl2br()
     *
     * @link http://www.php.net/manual/en/function.nl2br.php
     * @return void
     */
    public function testNl2brOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-25o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with clearstatcache()
     *
     * @link http://www.php.net/manual/en/function.clearstatcache.php
     * @return void
     */
    public function testClearstatcacheDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-26d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with clearstatcache()
     *
     * @link http://www.php.net/manual/en/function.clearstatcache.php
     * @return void
     */
    public function testClearstatcacheOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-26o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with opendir()
     *
     * @link http://www.php.net/manual/en/function.opendir.php
     * @return void
     */
    public function testOpendirDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-27d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with opendir()
     *
     * @link http://www.php.net/manual/en/function.opendir.php
     * @return void
     */
    public function testOpendirOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-27o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with scandir()
     *
     * @link http://www.php.net/manual/en/function.scandir.php
     * @return void
     */
    public function testScandirDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-28d.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with scandir()
     *
     * @link http://www.php.net/manual/en/function.scandir.php
     * @return void
     */
    public function testScandirOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-28o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with json_decode()
     *
     * @link http://www.php.net/manual/en/function.json-decode.php
     * @return void
     */
    public function testJsonDecodeDefaultSignature()
    {
        if (!extension_loaded('json')) {
            $this->markTestSkipped(
                "The 'json' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-29d.php');

        $this->assertSame(
            array('5.2.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with json_decode()
     *
     * @link http://www.php.net/manual/en/function.json-decode.php
     * @return void
     */
    public function testJsonDecodeOptionalSignature()
    {
        if (!extension_loaded('json')) {
            $this->markTestSkipped(
                "The 'json' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-29o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with openssl_sign()
     *
     * @link http://www.php.net/manual/en/function.openssl-sign.php
     * @return void
     */
    public function testOpensslDefaultSignature()
    {
        if (!extension_loaded('openssl')) {
            $this->markTestSkipped(
                "The 'openssl' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-30d.php');

        $this->assertSame(
            array('4.0.4', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with openssl_sign()
     *
     * @link http://www.php.net/manual/en/function.openssl-sign.php
     * @return void
     */
    public function testOpensslOptionalSignature()
    {
        if (!extension_loaded('openssl')) {
            $this->markTestSkipped(
                "The 'openssl' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-30o.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with preg_replace()
     *
     * @link http://www.php.net/manual/en/function.preg-replace.php
     * @return void
     */
    public function testPregReplaceDefaultSignature()
    {
        if (!extension_loaded('pcre')) {
            $this->markTestSkipped(
                "The 'pcre' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-31d.php');

        $this->assertSame(
            array('4.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with preg_replace()
     *
     * @link http://www.php.net/manual/en/function.preg-replace.php
     * @return void
     */
    public function testPregReplaceOptionalSignature()
    {
        if (!extension_loaded('pcre')) {
            $this->markTestSkipped(
                "The 'pcre' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-31o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with preg_replace_callback()
     *
     * @link http://www.php.net/manual/en/function.preg-replace-callback.php
     * @return void
     */
    public function testPregReplaceCallbackDefaultSignature()
    {
        if (!extension_loaded('pcre')) {
            $this->markTestSkipped(
                "The 'pcre' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-32d.php');

        $this->assertSame(
            array('4.0.5', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with preg_replace_callback()
     *
     * @link http://www.php.net/manual/en/function.preg-replace-callback.php
     * @return void
     */
    public function testPregReplaceCallbackOptionalSignature()
    {
        if (!extension_loaded('pcre')) {
            $this->markTestSkipped(
                "The 'pcre' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-32o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with session_regenerate_id()
     *
     * @link http://www.php.net/manual/en/function.session-regenerate-id.php
     * @return void
     */
    public function testSessionRegenerateIdDefaultSignature()
    {
        if (!extension_loaded('session')) {
            $this->markTestSkipped(
                "The 'session' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-33d.php');

        $this->assertSame(
            array('4.3.2', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with session_regenerate_id()
     *
     * @link http://www.php.net/manual/en/function.session-regenerate-id.php
     * @return void
     */
    public function testSessionRegenerateIdOptionalSignature()
    {
        if (!extension_loaded('session')) {
            $this->markTestSkipped(
                "The 'session' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-33o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with sqlite_fetch_column_types()
     *
     * @link http://www.php.net/manual/en/function.sqlite-fetch-column-types.php
     * @return void
     */
    public function testSqliteFetchColumnTypesDefaultSignature()
    {
        if (!extension_loaded('sqlite')) {
            $this->markTestSkipped(
                "The 'sqlite' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-34d.php');

        $this->assertSame(
            array('5.0.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with sqlite_fetch_column_types()
     *
     * @link http://www.php.net/manual/en/function.sqlite-fetch-column-types.php
     * @return void
     */
    public function testSqliteFetchColumnTypesOptionalSignature()
    {
        if (!extension_loaded('sqlite')) {
            $this->markTestSkipped(
                "The 'sqlite' extension is not available."
            );
        }

        $this->pci->parse(TEST_FILES_PATH . 'source18881-34o.php');

        $this->assertSame(
            array('5.1.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * example with getopt()
     *
     * @link http://www.php.net/manual/en/function.getopt.php
     * @return void
     */
    public function testGetoptDefaultSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-35d.php');

        $this->assertSame(
            array('4.3.0', ''), $this->pci->getVersions()
        );
    }

    /**
     * alternative example with getopt()
     *
     * @link http://www.php.net/manual/en/function.getopt.php
     * @return void
     */
    public function testGetoptOptionalSignature()
    {
        $this->pci->parse(TEST_FILES_PATH . 'source18881-35o.php');

        $this->assertSame(
            array('5.3.0', ''), $this->pci->getVersions()
        );
    }

}
