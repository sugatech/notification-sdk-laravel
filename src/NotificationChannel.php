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

        $background = method_exists($notification, 'isBackground') ?
            $notification->isBackground() :
            config('notification.channel_background');

        app('notification.client')->send($channels, $background);
    }
}