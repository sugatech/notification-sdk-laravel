<?php

namespace Notification\SDK;

use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;

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

        $collect = new Collection();
        foreach ($channels as $channel) {
            $channel->routeNotification($notifiable, $notification);
            $collect->add($channel);
        }

        app('notification.client')->send($collect, $this->background);
    }
}