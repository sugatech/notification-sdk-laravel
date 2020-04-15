<?php

namespace Notification\SDK\Channels;

class MailChannel extends Channel
{
    protected $key = 'mail';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}