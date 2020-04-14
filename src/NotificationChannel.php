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

        $channels->routeNotifications($notifiable, $notification);

        app('notification.client')->send($channels, $this->background);
    }
}