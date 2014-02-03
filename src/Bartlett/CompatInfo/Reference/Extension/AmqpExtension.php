<?php
namespace Bartlett\CompatInfo\Reference\Extension;

use Bartlett\CompatInfo\Reference\AbstractReference;

class AmqpExtension extends AbstractReference
{
    const REF_NAME    = 'amqp';
    const REF_VERSION = '1.2.0';    // 2013-05-28 (stable)

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
    }

    protected function getR00100()
    {
        $release = new \StdClass;
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
            'AMQPConnection'                => null,
            'AMQPConnectionException'       => null,
            'AMQPException'                 => null,
            'AMQPExchange'                  => null,
            'AMQPExchangeException'         => null,
            'AMQPQueue'                     => null,
            'AMQPQueueException'            => null,
        );
        return $release;
    }

    protected function getR10000()
    {
        $release = new \StdClass;
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
            'AMQPChannel'                   => null,
            'AMQPChannelException'          => null,
            'AMQPEnvelope'                  => null,
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
        $release = new \StdClass;
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
        $release = new \StdClass;
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
}
