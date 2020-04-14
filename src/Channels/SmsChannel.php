<?php

namespace Notification\SDK\Channels;

class SmsChannel extends Channel
{
    protected $key = 'sms';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}