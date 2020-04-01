<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\SmsBuilder;

class SmsPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $phoneNumbers;

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