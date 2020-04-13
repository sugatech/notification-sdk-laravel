<?php

namespace Notification\SDK;

use Illuminate\Notifications\Notification;

class NotificationChannel
{
    /**
     * @var bool
     */
    private $background;

    public function __construct($background)
    {
        $this->background = $background;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var ChannelCollection $channels */
        $channels = $notification->toNotificationService($notifiable);

        if (method_exists($notification, 'isBackground')) {
            app('notification.client')->send($channels, $notification->isBackground());
        } else {
            app('notification.client')->send($channels, $this->background);
        }
    }
}