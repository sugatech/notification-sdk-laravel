<?php

namespace Notification\SDK\Channels;

class DatabaseChannel extends Channel
{
    protected $key = 'database';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}