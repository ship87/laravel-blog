<?php

namespace App\Connectors;

use Illuminate\Contracts\Container\Container;
use Illuminate\Queue\Connectors\ConnectorInterface;

use App\Queues\RabbitMQQueue;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConnector implements ConnectorInterface
{
    /** @var AMQPStreamConnection */
    private $connection;

    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * RabbitMQConnector constructor.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Establish a queue connection.
     *
     * @param array $config
     *
     * @return \Illuminate\Contracts\Queue\Queue
     */
    public function connect(array $config)
    {
        $this->connection = new AMQPStreamConnection($config['host'], $config['port'], $config['login'], $config['password'], $config['vhost']);

        return new RabbitMQQueue($this->connection, $this->container, $config);
    }

    public function connection()
    {
        return $this->connection;
    }
}
