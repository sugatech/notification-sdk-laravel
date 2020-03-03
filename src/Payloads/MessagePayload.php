<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\FcmBuilder;
use Notification\SDK\Builders\MessageBuilder;

class MessagePayload implements Arrayable
{
    /**
     * @var FcmBuilder
     */
    private $fcmBuilder;

    /**
     * MessagePayload constructor.
     * @param MessageBuilder $message
     */
    public function __construct($message)
    {
        $this->fcmBuilder = $message->getFcmPayload();
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $message = [
            'fcm' => $this->fcmBuilder,
        ];

        $message = array_filter($message, function($value) {
            return $value !== null;
        });

        return $message;
    }
}