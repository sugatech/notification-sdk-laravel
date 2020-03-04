<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\SmsBuilder;

class SmsPayload extends Payload
{
    /**
     * @var string
     */
    protected $phoneNumber;

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
        $this->phoneNumber = $smsBuilder->getPhoneNumber();
        $this->content = $smsBuilder->getContent();
    }

    /**
     * convert SmsPayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'phone_number' => $this->phoneNumber,
            'content' => $this->content,
        ];
    }
}