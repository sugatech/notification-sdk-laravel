<?php

namespace Notification\SDK\Builder;

use Illuminate\Contracts\Support\Arrayable;

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
        $this->fcmBuilder = $message->getFcmBuilder();
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