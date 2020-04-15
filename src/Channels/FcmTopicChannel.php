<?php

namespace Notification\SDK\Channels;

class FcmTopicChannel extends Channel
{
    protected $key = 'fcm_topic';

    public function setNotificationFor($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor($this->key, $notification)) {
            return;
        }

        $this->payload->setTo($to);
    }
}