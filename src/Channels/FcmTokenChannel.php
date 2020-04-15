<?php

namespace Notification\SDK\Channels;

class FcmTokenChannel extends Channel
{
    protected $key = 'fcm_token';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}