<?php

namespace App\Interfaces;

interface RabbitMQPayloadPackerInterface
{
    public function pack($job, $queue, $data = '');

    public function unpack($raw, $queue);
}