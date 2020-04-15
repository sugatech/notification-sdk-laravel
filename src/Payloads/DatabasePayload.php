<?php

namespace Notification\SDK\Payloads;

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
     * @param array|string $to
     */
    public function setTo($to)
    {
        $this->notifiableIds = is_array($to) ? $to : [$to];
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