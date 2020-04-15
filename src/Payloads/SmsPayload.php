<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
use Notification\SDK\Builders\SmsBuilder;

class SmsPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $phoneNumbers = [];

    /**
     * @var string
     */
    protected $content;

    /**
     * SmsPayload constructor.
     * @param SmsBuilder $smsBuilder
     */
    public function __construct($smsBuilder)
    {
        $this->phoneNumbers = $smsBuilder->getPhoneNumbers();
        $this->content = $smsBuilder->getContent();
    }

    /**
     * @return string[]
     */
    public function getTo()
    {
        return $this->phoneNumbers;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('sms', $notification)) {
            return;
        }

        if (is_array($to)) {
            array_merge($this->phoneNumbers, $to);
        } else {
            $this->phoneNumbers[] = $to;
        }
    }

    /**
     * convert SmsPayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'phone_numbers' => $this->phoneNumbers,
            'content' => $this->content,
        ];
    }
}