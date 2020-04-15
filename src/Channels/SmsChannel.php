<?php

namespace Notification\SDK\Channels;

class SmsChannel extends Channel
{
    protected $key = 'sms';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}