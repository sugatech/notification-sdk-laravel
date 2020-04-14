<?php

namespace Notification\SDK\Channels;

class FcmChannel extends Channel
{
    protected $key = 'fcm';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}