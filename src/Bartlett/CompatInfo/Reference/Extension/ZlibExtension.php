<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class ZlibExtension extends AbstractReference
{
    const REF_NAME    = 'zlib';
    const REF_VERSION = '2.0';

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        //$version  = $this->getCurrentVersion();  // @FIXME
        $version  = $this->getLatestPhpVersion();
        $releases = array();

        // 4.0.0
        if (version_compare($version, '4.0.0', 'ge')) {
            $release = $this->getR40000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.1
        if (version_compare($version, '4.0.1', 'ge')) {
            $release = $this->getR40001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.4
        if (version_compare($version, '4.0.4', 'ge')) {
            $release = $this->getR40004();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.0.5
        if (version_compare($version, '4.0.5', 'ge')) {
            $release = $this->getR40005();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.0
        if (version_compare($version, '4.3.0', 'ge')) {
            $release = $this->getR40300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 4.3.2
        if (version_compare($version, '4.3.2', 'ge')) {
            $release = $this->getR40302();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 5.4.0
        if (version_compare($version, '5.4.0', 'ge')) {
            $release = $this->getR50400();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR40000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-05-22',
            'php.min' => '4.0.0',
            'php.max' => '',
        );
        $release->constants = array(
            'FORCE_DEFLATE'                 => null,
            'FORCE_GZIP'                    => null,
        );
        $release->functions = array(
            'gzclose'                       => null,
            'gzeof'                         => null,
            'gzfile'                        => null,
            'gzgetc'                        => null,
            'gzgets'                        => null,
            'gzgetss'                       => null,
            'gzopen'                        => null,
            'gzpassthru'                    => null,
            'gzputs'                        => null,
            'gzread'                        => null,
            'gzrewind'                      => null,
            'gzseek'                        => null,
            'gztell'                        => null,
            'gzwrite'                       => null,
            'readgzfile'                    => null,
        );
        return $release;
    }

    protected function getR40001()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-06-28',
            'php.min' => '4.0.1',
            'php.max' => '',
        );
        $release->functions = array(
            'gzcompress'                    => null,
            'gzuncompress'                  => null,
        );
        return $release;
    }

    protected function getR40004()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.4',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2000-12-19',
            'php.min' => '4.0.4',
            'php.max' => '',
        );
        $release->functions = array(
            'gzdeflate'                     => null,
            'gzencode'                      => null,
            'gzinflate'                     => null,
            'ob_gzhandler'                  => null,
        );
        return $release;
    }

    protected function getR40005()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.0.5',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2001-04-30',
            'php.min' => '4.0.5',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'zlib.output_compression'       => null,
        );
        return $release;
    }

    protected function getR40300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2002-12-27',
            'php.min' => '4.3.0',
            'php.max' => '',
        );
        $release->iniEntries = array (
            'zlib.output_compression_level' => null,
            'zlib.output_handler'           => null,
        );
        return $release;
    }

    protected function getR40302()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '4.3.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2003-05-29',
            'php.min' => '4.3.2',
            'php.max' => '',
        );
        $release->functions = array(
            'zlib_get_coding_type'          => null,
        );
        return $release;
    }

    protected function getR50400()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '5.4.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-03-01',
            'php.min' => '5.4.0',
            'php.max' => '',
        );
        $release->constants = array(
            'ZLIB_ENCODING_DEFLATE'         => null,
            'ZLIB_ENCODING_GZIP'            => null,
            'ZLIB_ENCODING_RAW'             => null,
        );
        $release->functions = array(
            'gzdecode'                      => null,
            'zlib_decode'                   => null,
            'zlib_encode'                   => null,
        );
        return $release;
    }
}
