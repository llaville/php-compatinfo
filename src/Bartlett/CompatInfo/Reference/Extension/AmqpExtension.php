<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class AmqpExtension extends AbstractReference
{
    const REF_NAME    = 'amqp';
    const REF_VERSION = '1.4.0';    // 2013-04-14 (stable)

    public function __construct()
    {
        parent::__construct(self::REF_NAME, self::REF_VERSION);

        $version  = $this->getCurrentVersion();
        $releases = array();

        // 0.1.0
        if (version_compare($version, '0.1.0', 'ge')) {
            $release = $this->getR00100();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.0
        if (version_compare($version, '1.0.0', 'ge')) {
            $release = $this->getR10000();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.8
        if (version_compare($version, '1.0.8', 'ge')) {
            $release = $this->getR10008();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.0.10
        if (version_compare($version, '1.0.10', 'ge')) {
            $release = $this->getR10010();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }

        // 1.3.0
        if (version_compare($version, '1.3.0', 'ge')) {
            $release = $this->getR10300();
            $count = array_push($releases, $release);
            $this->storage->attach($releases[--$count]);
        }
    }

    protected function getR00100()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '0.1.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2010-06-19',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'amqp.host'                     => null,
            'amqp.vhost'                    => null,
            'amqp.port'                     => null,
            'amqp.login'                    => null,
            'amqp.password'                 => null,
        );
        $release->classes = array(
            'AMQPConnection'                => array(
                'methods' => array(
                    '__construct'           => array('ext.min' => '0.2.0'),
                    'isConnected'           => array('ext.min' => '0.2.0'),
                    'connect'               => array('ext.min' => '0.2.0'),
                    'pconnect'              => array('ext.min' => '1.0.0'),
                    'pdisconnect'           => array('ext.min' => '1.0.10'),
                    'disconnect'            => array('ext.min' => '0.2.0'),
                    'reconnect'             => array('ext.min' => '0.2.0'),
                    'getLogin'              => array('ext.min' => '1.0.0'),
                    'setLogin'              => array('ext.min' => '0.2.0'),
                    'getPassword'           => array('ext.min' => '1.0.0'),
                    'setPassword'           => array('ext.min' => '0.2.0'),
                    'getHost'               => array('ext.min' => '1.0.0'),
                    'setHost'               => array('ext.min' => '0.2.0'),
                    'getPort'               => array('ext.min' => '1.0.0'),
                    'setPort'               => array('ext.min' => '0.2.0'),
                    'getVhost'              => array('ext.min' => '1.0.0'),
                    'setVhost'              => array('ext.min' => '0.2.0'),
                    'getTimeout'            => array('ext.min' => '1.0.10'),
                    'setTimeout'            => array('ext.min' => '1.0.10'),
                    'getReadTimeout'        => array('ext.min' => '1.0.10'),
                    'setReadTimeout'        => array('ext.min' => '1.0.10'),
                    'getWriteTimeout'       => array('ext.min' => '1.0.10'),
                    'setWriteTimeout'       => array('ext.min' => '1.0.10'),
                ),
            ),
            'AMQPConnectionException'       => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                    '__clone'               => null,
                ),
            ),
            'AMQPException'                 => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                    '__clone'               => null,
                ),
            ),
            'AMQPExchange'                  => array(
                'methods' => array(
                    '__construct'           => array('ext.min' => '0.2.0'),
                    'getName'               => array('ext.min' => '1.0.0'),
                    'setName'               => array('ext.min' => '1.0.0'),
                    'getFlags'              => array('ext.min' => '1.0.0'),
                    'setFlags'              => array('ext.min' => '1.0.0'),
                    'getType'               => array('ext.min' => '1.0.0'),
                    'setType'               => array('ext.min' => '1.0.0'),
                    'getArgument'           => array('ext.min' => '1.0.0'),
                    'getArguments'          => array('ext.min' => '1.0.0'),
                    'setArgument'           => array('ext.min' => '1.0.0'),
                    'setArguments'          => array('ext.min' => '1.0.0'),
                    'declareExchange'       => array('ext.min' => '1.0.10'),
                    'bind'                  => array('ext.min' => '0.2.0'),
                    'delete'                => array('ext.min' => '0.2.0'),
                    'publish'               => array('ext.min' => '0.2.0'),
                    'getChannel'            => array('ext.min' => '1.4.0beta2'),
                    'getConnection'         => array('ext.min' => '1.4.0beta2'),
                    'declare'               => array('ext.min' => '0.2.0'),
                ),
            ),
            'AMQPExchangeException'         => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                    '__clone'               => null,
                ),
            ),
            'AMQPQueue'                     => array(
                'methods' => array(
                    '__construct'           => array('ext.min' => '0.2.0'),
                    'getName'               => array('ext.min' => '0.3.1'),
                    'setName'               => array('ext.min' => '1.0.0'),
                    'getFlags'              => array('ext.min' => '1.0.0'),
                    'setFlags'              => array('ext.min' => '1.0.0'),
                    'getArgument'           => array('ext.min' => '1.0.0'),
                    'getArguments'          => array('ext.min' => '1.0.0'),
                    'setArgument'           => array('ext.min' => '1.0.0'),
                    'setArguments'          => array('ext.min' => '1.0.0'),
                    'declareQueue'          => array('ext.min' => '1.0.10'),
                    'bind'                  => array('ext.min' => '0.2.0'),
                    'get'                   => array('ext.min' => '0.2.0'),
                    'consume'               => array('ext.min' => '0.2.0'),
                    'ack'                   => array('ext.min' => '0.2.0'),
                    'nack'                  => array('ext.min' => '1.0.0'),
                    'reject'                => array('ext.min' => '1.0.0'),
                    'purge'                 => array('ext.min' => '0.2.0'),
                    'cancel'                => array('ext.min' => '0.2.0'),
                    'delete'                => array('ext.min' => '0.2.0'),
                    'unbind'                => array('ext.min' => '0.2.0'),
                    'getChannel'            => array('ext.min' => '1.4.0beta1'),
                    'getConnection'         => array('ext.min' => '1.4.0beta2'),
                    'declare'               => array('ext.min' => '0.2.0'),
                ),
            ),
            'AMQPQueueException'            => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                    '__clone'               => null,
                ),
            ),
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.0',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-02-15',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'amqp.auto_ack'                 => null,
            'amqp.prefetch_count'           => null,
        );
        $release->classes = array(
            'AMQPChannel'                   => array(
                'methods' => array(
                    '__construct'           => null,
                    'isConnected'           => null,
                    'getChannelId'          => array('ext.min' => '1.2.0'),
                    'setPrefetchSize'       => null,
                    'getPrefetchSize'       => array('ext.min' => '1.2.0'),
                    'setPrefetchCount'      => null,
                    'getPrefetchCount'      => array('ext.min' => '1.2.0'),
                    'qos'                   => null,
                    'startTransaction'      => null,
                    'commitTransaction'     => null,
                    'rollbackTransaction'   => null,
                    'getConnection'         => array('ext.min' => '1.4.0'),
                ),
            ),
            'AMQPChannelException'          => array(
                'methods' => array(
                    '__construct'           => null,
                    'getMessage'            => null,
                    'getCode'               => null,
                    'getFile'               => null,
                    'getLine'               => null,
                    'getTrace'              => null,
                    'getPrevious'           => null,
                    'getTraceAsString'      => null,
                    '__toString'            => null,
                    '__clone'               => null,
                ),
            ),
            'AMQPEnvelope'                  => array(
                'methods' => array(
                    '__construct'           => null,
                    'getBody'               => null,
                    'getRoutingKey'         => null,
                    'getDeliveryMode'       => null,
                    'getDeliveryTag'        => null,
                    'getExchangeName'       => null,
                    'isRedelivery'          => null,
                    'getContentType'        => null,
                    'getContentEncoding'    => null,
                    'getType'               => null,
                    'getTimestamp'          => null,
                    'getPriority'           => null,
                    'getExpiration'         => null,
                    'getUserId'             => null,
                    'getAppId'              => null,
                    'getMessageId'          => null,
                    'getReplyTo'            => null,
                    'getCorrelationId'      => null,
                    'getHeader'             => null,
                    'getHeaders'            => null,
                ),
            ),
        );
        $release->constants = array(
            'AMQP_AUTOACK'                  => null,
            'AMQP_AUTODELETE'               => null,
            'AMQP_DURABLE'                  => null,
            'AMQP_EXCLUSIVE'                => null,
            'AMQP_EX_TYPE_DIRECT'           => null,
            'AMQP_EX_TYPE_FANOUT'           => null,
            'AMQP_EX_TYPE_HEADERS'          => null,
            'AMQP_EX_TYPE_TOPIC'            => null,
            'AMQP_IFEMPTY'                  => null,
            'AMQP_IFUNUSED'                 => null,
            'AMQP_IMMEDIATE'                => null,
            'AMQP_INTERNAL'                 => null,
            'AMQP_MANDATORY'                => null,
            'AMQP_MULTIPLE'                 => null,
            'AMQP_NOLOCAL'                  => null,
            'AMQP_NOPARAM'                  => null,
            'AMQP_NOWAIT'                   => null,
            'AMQP_PASSIVE'                  => null,
            'AMQP_REQUEUE'                  => null,
        );
        return $release;
    }

    protected function getR10008()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.8',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2012-11-12',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'amqp.timeout'                  => null,
        );
        $release->constants = array(
            'AMQP_OS_SOCKET_TIMEOUT_ERRNO'  => null,
        );
        return $release;
    }

    protected function getR10010()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.0.10',
            'ext.max' => '',
            'state'   => 'stable',
            'date'    => '2013-04-19',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'amqp.read_timeout'             => null,
            'amqp.write_timeout'            => null,
        );
        return $release;
    }

    protected function getR10300()
    {
        $release = new \stdClass;
        $release->info = array(
            'ext.min' => '1.3.0',
            'ext.max' => '',
            'state'   => 'beta',
            'date'    => '2013-11-25',
            'php.min' => '5.2.0',
            'php.max' => '',
        );
        $release->iniEntries = array(
            'amqp.connect_timeout'          => null,
        );
        return $release;
    }
}
