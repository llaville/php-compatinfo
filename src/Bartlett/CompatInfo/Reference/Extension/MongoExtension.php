<?php

namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class MongoExtension extends AbstractReference
{
    const REF_NAME    = 'mongo';
    const REF_VERSION = '1.5.3';    // 2014-06-05 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.9.0
        if (version_compare($version, '0.9.0', 'ge')) {
            $release = $this->getR00900();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.1
        if (version_compare($version, '1.0.1', 'ge')) {
            $release = $this->getR10001();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.3
        if (version_compare($version, '1.0.3', 'ge')) {
            $release = $this->getR10003();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.9
        if (version_compare($version, '1.0.9', 'ge')) {
            $release = $this->getR10009();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.2.3
        if (version_compare($version, '1.2.3', 'ge')) {
            $release = $this->getR10203();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.3.0RC1
        if (version_compare($version, '1.3.0RC1', 'ge')) {
            $release = $this->getR10300RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.3.0RC3
        if (version_compare($version, '1.3.0RC3', 'ge')) {
            $release = $this->getR10300RC3();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.4.2
        if (version_compare($version, '1.4.2', 'ge')) {
            $release = $this->getR10402();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.5.0alpha1
        if (version_compare($version, '1.5.0alpha1', 'ge')) {
            $release = $this->getR10500a1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.5.0RC1
        if (version_compare($version, '1.5.0RC1', 'ge')) {
            $release = $this->getR10500RC1();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00900()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '0.9.0',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2009-05-20',
            'php.min' => '5.0.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'mongo.allow_empty_keys'        => null,
            'mongo.chunk_size'              => null,
            'mongo.cmd'                     => null,
            'mongo.default_host'            => null,
            'mongo.default_port'            => null,
            'mongo.is_master_interval'      => null,
            'mongo.long_as_object'          => null,
            'mongo.native_long'             => null,
            'mongo.ping_interval'           => null,
        );
        $release->classes = array(
            // Core
            'Mongo'                         => null,
            'MongoUtil'                     => array('ext.max' => '0.9.0'),
            'MongoCollection'               => array(
                'methods' => array(
                    'aggregateCursor'       => array(
                        'ext.min' => '1.5.0RC2'
                    ),
                ),
            ),
            'MongoCursor'                   => array(
                'methods' => array(
                    'maxTimeMS'             => array(
                        'ext.min' => '1.5.0alpha1'
                    ),
                ),
            ),
            'MongoDB'                       => null,

            // Types
            'MongoCode'                     => null,
            'MongoId'                       => null,
            'MongoRegex'                    => null,
            'MongoBinData'                  => null,
            'MongoDate'                     => null,
            'MongoDBRef'                    => null,

            // GridFS
            'MongoGridFS'                   => null,
            'MongoGridFSFile'               => null,
            'MongoGridFSCursor'             => null,

            // Exceptions
            'MongoException'                => null,
            'MongoCursorException'          => null,
            'MongoConnectionException'      => null,
            'MongoGridFSException'          => null,
        );
        return $release;
    }

    protected function getR10001()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.1',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2009-11-19',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            // Types
            'MongoTimestamp'                => null,
            'MongoMaxKey'                   => null,
            'MongoMinKey'                   => null,
        );
        $release->functions = array(
            'bson_decode'                   => null,
            'bson_encode'                   => null,
        );
        return $release;
    }

    protected function getR10003()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-01-07',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            // Exceptions
            'MongoCursorTimeoutException'   => null,
        );
        return $release;
    }

    protected function getR10009()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.0.9',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2010-08-06',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            // Types
            'MongoInt32'                    => null,
            'MongoInt64'                    => null,
        );
        return $release;
    }

    protected function getR10203()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.2.3',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2011-08-15',
            'php.min' => '5.1.0',
            'php.max' => '',
        );
        $release->classes = array(
            // Miscellaneous
            'MongoLog'                      => null,
            'MongoPool'                     => null,
        );
        return $release;
    }

    protected function getR10300RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.3.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-11-05',
            'php.min' => '5.2.6',
            'php.max' => '',
        );
        $release->classes = array(
            // Exceptions
            'MongoResultException'          => null,
        );
        return $release;
    }

    protected function getR10300RC3()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.3.0RC3',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2012-11-20',
            'php.min' => '5.2.6',
            'php.max' => '',
        );
        $release->classes = array(
            // Core
            'MongoClient'                           => array(
                'methods' => array(
                    'getWriteConcern'               => array(
                        'ext.min' => '1.5.0RC2'
                    ),
                    'setWriteConcern'               => array(
                        'ext.min' => '1.5.0RC2'
                    ),
                ),
            ),
        );
        return $release;
    }

    protected function getR10402()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.4.2',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-07-23',
            'php.min' => '5.2.6',
            'php.max' => '',
        );
        $release->constants = array(
            'MONGO_STREAMS'                 => null,
        );
        return $release;
    }

    protected function getR10500a1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.5.0alpha1',
            'ext.max' => '',
            'state'   => 'alpha',
            'date'    => '2014-02-25',
            'php.min' => '5.2.6',
            'php.max' => '',
        );
        $release->classes = array(
            'MongoCommandCursor'                            => null,
            'MongoDeleteBatch'                              => null,
            'MongoDuplicateKeyException'                    => null,
            'MongoExecutionTimeoutException'                => null,
            'MongoInsertBatch'                              => null,
            'MongoProtocolException'                        => null,
            'MongoUpdateBatch'                              => null,
            'MongoWriteBatch'                      => array(
                'methods' => array(
                    'getBatchInfo'                 => array(
                        'ext.min' => '1.5.0RC2'
                    ),
                ),
            ),
            'MongoWriteConcernException'                    => null,
        );
        $release->interfaces = array(
            'MongoCursorInterface'                          => null,
        );
        $release->constants = array(
            'MONGO_STREAM_NOTIFY_IO_COMPLETED'              => null,
            'MONGO_STREAM_NOTIFY_IO_PROGRESS'               => null,
            'MONGO_STREAM_NOTIFY_IO_READ'                   => null,
            'MONGO_STREAM_NOTIFY_IO_WRITE'                  => null,
            'MONGO_STREAM_NOTIFY_LOG_BATCHINSERT'           => null,
            'MONGO_STREAM_NOTIFY_LOG_CMD_DELETE'            => null,
            'MONGO_STREAM_NOTIFY_LOG_CMD_INSERT'            => null,
            'MONGO_STREAM_NOTIFY_LOG_CMD_UPDATE'            => null,
            'MONGO_STREAM_NOTIFY_LOG_DELETE'                => null,
            'MONGO_STREAM_NOTIFY_LOG_GETMORE'               => null,
            'MONGO_STREAM_NOTIFY_LOG_INSERT'                => null,
            'MONGO_STREAM_NOTIFY_LOG_KILLCURSOR'            => null,
            'MONGO_STREAM_NOTIFY_LOG_QUERY'                 => null,
            'MONGO_STREAM_NOTIFY_LOG_RESPONSE_HEADER'       => null,
            'MONGO_STREAM_NOTIFY_LOG_UPDATE'                => null,
            'MONGO_STREAM_NOTIFY_LOG_WRITE_REPLY'           => null,
            'MONGO_STREAM_NOTIFY_TYPE_IO_INIT'              => null,
            'MONGO_STREAM_NOTIFY_TYPE_LOG'                  => null,
            'MONGO_SUPPORTS_AUTH_MECHANISM_GSSAPI'          => null,
            'MONGO_SUPPORTS_AUTH_MECHANISM_MONGODB_CR'      => null,
            'MONGO_SUPPORTS_AUTH_MECHANISM_MONGODB_X509'    => null,
            'MONGO_SUPPORTS_AUTH_MECHANISM_PLAIN'           => null,
            'MONGO_SUPPORTS_SSL'                            => null,
            'MONGO_SUPPORTS_STREAMS'                        => null,
        );
        return $release;
    }

    protected function getR10500RC1()
    {
        $release = new \StdClass;
        $release->info = array(
            'ext.min' => '1.5.0RC1',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2014-03-11',
            'php.min' => '5.2.6',
            'php.max' => '',
        );
        $release->classes = array(

        );
        $release->constants = array(
            'MONGO_STREAM_NOTIFY_LOG_WRITE_BATCH'           => null,
        );

        return $release;
    }
}
