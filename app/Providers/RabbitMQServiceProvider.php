<?php

namespace App\Providers;

use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;

use App\Interfaces\RabbitMQPayloadPackerInterface;
use App\Connectors\RabbitMQConnector;

class RabbitMQServiceProvider extends ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../../config/laravel-rabbit.php';

    const QUEUE_CONFIG_PATH = __DIR__.'/../../config/rabbitmq.php';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(static::QUEUE_CONFIG_PATH, 'queue.connections.rabbitmq');
        $this->mergeConfigFrom(static::CONFIG_PATH, 'laravel-rabbit');
    }

    /**
     * Register the application's event listeners.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();

        /** @var QueueManager $queue */
        $queue = $this->app['queue'];
        $connector = new RabbitMQConnector($this->app);

        $queue->stopping(function () use ($connector) {
            $connector->connection()->close();
        });

        $queue->addConnector('rabbitmq', function () use ($connector) {
            return $connector;
        });

        $this->app->singleton(RabbitMQPayloadPackerInterface::class, function ($app) {
            $packerClass = $app['config']->get('laravel-rabbit.payload_packer');

            return $app->make($packerClass);
        });
    }

    protected function publishConfig()
    {
        if (function_exists('config_path')) {
            $publishPath = config_path('laravel-rabbit.php');
        } else {
            $publishPath = base_path('config/laravel-rabbit.php');
        }
        $this->publishes([static::CONFIG_PATH => $publishPath], 'config');
    }
}