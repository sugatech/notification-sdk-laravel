<?php

namespace Notification\SDK\Channels;

class FcmChannel extends Channel
{
    protected $key = 'fcm';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}