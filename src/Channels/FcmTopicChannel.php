<?php

namespace Notification\SDK\Channels;

class FcmTopicChannel extends Channel
{
    protected $key = 'fcm_topic';

    public function getTo($notifiable, $notification)
    {
        return $notifiable->routeNotificationFor($this->key, $notification);
    }
}