<?php

namespace App\PayloadPackers;

use App\Interfaces\RabbitMQPayloadPackerInterface;
use App\Exceptions\RabbitMQInvalidPayloadException;

class RabbitMQPayloadPacker implements RabbitMQPayloadPackerInterface
{
    /**
     * @param        $job
     * @param string $data
     * @param null $queue
     * @return string
     */
    public function pack($job, $queue, $data = '')
    {
        $payload = json_encode($this->createPayloadArray($job, $queue, $data));

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new RabbitMQInvalidPayloadException(json_last_error());
        }

        return $payload;
    }

    /**
     * Create a payload array from the given job and data.
     *
     * @param        $job
     * @param        $queue
     * @param string $data
     * @return array
     */
    protected function createPayloadArray($job, $queue, $data = '')
    {
        return is_object($job) ? $this->createObjectPayload($job) : $this->createStringPayload($job, $data);
    }

    /**
     * Create a payload for an object-based queue handler.
     *
     * @param  mixed $job
     * @return array
     */
    protected function createObjectPayload($job)
    {
        return [
            'displayName' => $this->getDisplayName($job),
            'job' => 'Illuminate\Queue\CallQueuedHandler@call',
            'maxTries' => isset($job->tries) ? $job->tries : null,
            'timeout' => isset($job->timeout) ? $job->timeout : null,
            'data' => [
                'commandName' => get_class($job),
                'command' => serialize(clone $job),
            ],
        ];
    }

    /**
     * Get the display name for the given job.
     *
     * @param  mixed $job
     * @return string
     */
    protected function getDisplayName($job)
    {
        return method_exists($job, 'displayName') ? $job->displayName() : get_class($job);
    }

    /**
     * Create a typical, string based queue payload array.
     *
     * @param  string $job
     * @param  mixed $data
     * @return array
     */
    protected function createStringPayload($job, $data)
    {
        return [
            'displayName' => is_string($job) ? explode('@', $job)[0] : null,
            'job' => $job,
            'maxTries' => null,
            'timeout' => null,
            'data' => $data,
        ];
    }

    /**
     * @param $raw
     * @param $queue
     * @return mixed
     */
    public function unpack($raw, $queue)
    {
        return json_decode($raw, true);
    }
}