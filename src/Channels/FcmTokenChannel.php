<?php

namespace Notification\SDK\Channels;

class FcmTokenChannel extends Channel
{
    protected $key = 'fcm_token';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}