<?php

namespace Notification\SDK;

use Illuminate\Support\Facades\Notification;
use Notification\SDK\Builders\MessageBuilder;

class NotificationChannel
{
    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var MessageBuilder $message */
        $message = $notification->toNotificationService($notifiable);

        app('notification.client')->send($message);
    }
}