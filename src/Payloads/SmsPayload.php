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
     * @return string[]
     */
    public function getTo()
    {
        return $this->phoneNumbers;
    }

    /**
     * @param string|string[] $to
     */
    public function setTo($to)
    {
        $this->phoneNumbers = is_array($to) ? $to : [$to];
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