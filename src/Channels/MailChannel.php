<?php

namespace Notification\SDK\Channels;

class MailChannel extends Channel
{
    protected $key = 'mail';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}