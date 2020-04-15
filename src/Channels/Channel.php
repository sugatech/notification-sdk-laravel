<?php

namespace Notification\SDK\Channels;

use Illuminate\Notifications\Notification;
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

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function routeNotificationFor($notifiable, $notification)
    {
        if (!empty($this->payload->getTo())) {
            return;
        }

        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}