<?php

namespace Notification\SDK;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Notification\SDK\Channels\Channel;

class ChannelCollection implements Arrayable
{
    /**
     * @var Channel[]|Collection
     */
    private $channels;

    /**
     * ChannelCollection constructor.
     */
    public function __construct()
    {
        $this->channels = new Collection();
    }

    /**
     * @param Channel $channel
     * @return ChannelCollection
     */
    public function add($channel)
    {
        $this->channels->add($channel);
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->channels->map(function (Channel $channel) {
            return [
                'key' => $channel->getKey(),
                'body' => $channel->getPayload()->toArray(),
            ];
        })->all();
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function routeNotificationFor($notifiable, $notification)
    {
        foreach ($this->channels as $channel) {
            $channel->routeNotificationFor($notifiable, $notification);
        }
    }
}