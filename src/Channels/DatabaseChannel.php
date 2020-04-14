<?php

namespace Notification\SDK\Channels;

class DatabaseChannel extends Channel
{
    protected $key = 'database';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}