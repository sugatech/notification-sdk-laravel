<?php

namespace Notification\SDK\Channels;

use Notification\SDK\Payloads\Payload;

abstract class Channel
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var Payload
     */
    protected $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return Payload
     */
    public function getPayload(): Payload
    {
        return $this->payload;
    }

    abstract public function setNotificationFor($notifiable, $notification);
}