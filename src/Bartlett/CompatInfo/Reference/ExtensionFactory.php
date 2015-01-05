<?php

namespace Bartlett\CompatInfo\Reference;

/**
 * Extension factory to build a concrete Reference instance with all releases,
 * independent from the platform.
 *
 * @category PHP
 * @package  PHP_CompatInfo
 * @author   Laurent Laville <pear@laurent-laville.org>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version  Release: @package_version@
 * @link     http://php5.laurent-laville.org/compatinfo/
 * @since    Class available since Release 4.0.0-alpha2
 */

class ExtensionFactory implements ReferenceInterface
{
    const LATEST_PHP_5_2 = '5.2.17';
    const LATEST_PHP_5_3 = '5.3.29';
    const LATEST_PHP_5_4 = '5.4.36';
    const LATEST_PHP_5_5 = '5.5.20';
    const LATEST_PHP_5_6 = '5.6.4';

    protected $storage;

    private $name;

    public function __construct($name)
    {
        $this->storage = new SqliteStorage($name);
        $this->name    = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMetaVersion($key = null, $extname = null)
    {
        if (in_array('curl', array($this->name, $extname))
            && function_exists('curl_version')
        ) {
            $meta = curl_version();
            $meta['version_text'] = $meta['version'];

        } elseif (in_array('libxml', array($this->name, $extname))) {
            $meta = array(
                'version_number' => LIBXML_VERSION,
                'version_text'   => LIBXML_DOTTED_VERSION,
            );

        } elseif (in_array('intl', array($this->name, $extname))) {
            $meta = array(
                'version_number' => defined('INTL_ICU_VERSION')
                    ? INTL_ICU_VERSION : false,
                'version_text'   => defined('INTL_ICU_VERSION')
                    ? INTL_ICU_VERSION : false,
            );

        } elseif (in_array('openssl', array($this->name, $extname))) {
            $meta = array(
                'version_number' => defined('OPENSSL_VERSION_NUMBER')
                    ? OPENSSL_VERSION_NUMBER : false,
                'version_text'   => defined('OPENSSL_VERSION_TEXT')
                    ? OPENSSL_VERSION_TEXT : false,
            );
        }
        if (isset($meta)) {
            if (isset($key) && array_key_exists($key, $meta)) {
                return $meta[$key];
            }
            return $meta;
        }
        return false;
    }

    public function getCurrentVersion()
    {
        $version = phpversion($this->name);
        $pattern = '/^[0-9]+\.[0-9]+/';
        if (empty($this->version) || !preg_match($pattern, $version)) {
            /**
             * When version is not provided by the extension, or not standard format
             * or we don't have it in our reference (ex snmp) because have no sense
             * be sure at least to return latest PHP version supported.
             */
            $version = $this->getLatestPhpVersion();
        }
        return $version;
    }

    public function getLatestVersion()
    {
        if (!empty($this->version)) {
            return $this->version;
        }
        return $this->getLatestPhpVersion();
    }

    public function getLatestPhpVersion()
    {
        if (version_compare(PHP_VERSION, '5.3', 'lt')) {
            return self::LATEST_PHP_5_2;
        }
        if (version_compare(PHP_VERSION, '5.4', 'lt')) {
            return self::LATEST_PHP_5_3;
        }
        if (version_compare(PHP_VERSION, '5.5', 'lt')) {
            return self::LATEST_PHP_5_4;
        }
        if (version_compare(PHP_VERSION, '5.6', 'lt')) {
            return self::LATEST_PHP_5_5;
        }
        return self::LATEST_PHP_5_6;
    }

    public function getReleases()
    {
        return $this->storage->getMetaData('releases');
    }

    public function getInterfaces()
    {
        return $this->storage->getMetaData('interfaces');
    }

    public function getClasses()
    {
        return $this->storage->getMetaData('classes');
    }

    public function getFunctions()
    {
        return $this->storage->getMetaData('functions');
    }

    public function getConstants()
    {
        return $this->storage->getMetaData('constants');
    }

    public function getIniEntries()
    {
        return $this->storage->getMetaData('iniEntries');
    }

    public function getClassConstants()
    {
        return $this->storage->getMetaData('classConstants');
    }

    public function getClassStaticMethods()
    {
        return $this->storage->getMetaData('classMethods', true);
    }

    public function getClassMethods()
    {
        return $this->storage->getMetaData('classMethods', false);
    }
}
