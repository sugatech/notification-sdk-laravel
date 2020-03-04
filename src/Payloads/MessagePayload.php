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
            'fcm' => $this->fcmPayload,
            'database' => $this->databasePayload,
            'mail' => $this->mailPayload,
            'sms' => $this->smsPayload,
            'fcm_token' => $this->fcmTokenPayload,
            'fcm_topic' => $this->fcmTopicPayload,
        ];

        $message = array_filter($message, function($value) {
            return $value !== null;
        });

        return $message;
    }
}