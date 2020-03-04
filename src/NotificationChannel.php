<?php

namespace Notification\SDK;

use Illuminate\Notifications\Notification;

class NotificationChannel
{
    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var ChannelCollection $channels */
        $channels = $notification->toNotificationService($notifiable);

        app('notification.client')->send($channels);
    }
}