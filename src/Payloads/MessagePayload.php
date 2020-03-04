<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\MessageBuilder;

class MessagePayload implements Arrayable
{
    /**
     * @var FcmPayload
     */
    private $fcmPayload;

    /**
     * @var DatabasePayload
     */
    private $databasePayload;

    /**
     * @var MailPayload
     */
    private $mailPayload;

    /**
     * @var SmsPayload
     */
    private $smsPayload;

    /**
     * @var FcmTokenPayload
     */
    private $fcmTokenPayload;

    /**
     * @var FcmTopicPayload
     */
    private $fcmTopicPayload;

    /**
     * MessagePayload constructor.
     * @param MessageBuilder $message
     */
    public function __construct($message)
    {
        $this->fcmPayload = $message->getFcmPayload();
        $this->databasePayload = $message->getDatabasePayload();
        $this->mailPayload = $message->getMailPayload();
        $this->smsPayload = $message->getSmsPayload();
        $this->fcmTokenPayload = $message->getFcmTokenPayload();
        $this->fcmTopicPayload = $message->getFcmTopicPayload();
    }

    /**
     * convert MessagePayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        $message = [
            'fcm' => $this->fcmPayload->toArray(),
            'database' => $this->databasePayload->toArray(),
            'mail' => $this->mailPayload->toArray(),
            'sms' => $this->smsPayload->toArray(),
            'fcm_token' => $this->fcmTokenPayload->toArray(),
            'fcm_topic' => $this->fcmTopicPayload->toArray(),
        ];

        $message = array_filter($message, function($value) {
            return $value !== null;
        });

        return $message;
    }
}