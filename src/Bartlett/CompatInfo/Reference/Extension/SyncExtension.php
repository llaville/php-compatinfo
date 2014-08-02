<?php
/**
 * Sync extension Reference
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    PHP_CompatInfo
 * @subpackage Tests
 * @author     Laurent Laville <pear@laurent-laville.org>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version    GIT: $Id$
 * @link       http://php5.laurent-laville.org/compatinfo/
 * @since      Class available since Release 3.3.0
 */

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class SyncExtension extends AbstractReference
{
    const REF_NAME    = 'sync';
    const REF_VERSION = '1.0.1';    // 2014-07-25 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR10000()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2014-07-05',
            'php.min' => '5.3.0',
            'php.max' => '',
        );
        $release->classes = array(
            'SyncEvent'             => null,
            'SyncMutex'             => null,
            'SyncReaderWriter'      => null,
            'SyncSemaphore'         => null,
        );
        return $release;
    }
}
