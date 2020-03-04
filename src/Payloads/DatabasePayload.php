<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\DatabaseBuilder;

class DatabasePayload extends Payload
{
    /**
     * @var int
     */
    protected $notifiableId;

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
        $this->notifiableId = $databaseBuilder->getNotifiableId();
        $this->data = $databaseBuilder->getData();
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'notifiable_id' => $this->notifiableId,
            'data' => $this->data,
        ];
    }
}