<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
use Notification\SDK\Builders\DatabaseBuilder;

class DatabasePayload extends Payload
{
    /**
     * @var array
     */
    protected $notifiableIds;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * DatabasePayload constructor.
     * @param DatabaseBuilder $databaseBuilder
     */
    public function __construct($databaseBuilder)
    {
        $this->notifiableIds = $databaseBuilder->getNotifiableIds();
        $this->data = $databaseBuilder->getData();
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->notifiableIds;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('database', $notification)) {
            return;
        }

        if (is_array($to)) {
            $this->notifiableIds = $to;
        } else {
            $this->notifiableIds[] = $to;
        }
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'notifiable_ids' => $this->notifiableIds,
            'data' => $this->data,
        ];
    }
}