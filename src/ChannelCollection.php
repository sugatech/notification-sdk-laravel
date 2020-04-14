<?php

namespace Notification\SDK;

use Illuminate\Support\Collection;
use Notification\SDK\Channels\Channel;

class ChannelCollection
{
    /**
     * @var Collection
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
        return $this->channels->mapWithKeys(function (Channel $channel) {
            return [$channel->getKey() => $channel->getPayload()->toArray()];
        })->all();
    }

    public function getTo($notifiable, $notification)
    {
        $collect = new Collection();
        foreach ($this->channels as $channel) {
            $channel->routeNotification($notifiable, $notification);
            $collect->add($channel);
        }

        return $collect;
    }
}