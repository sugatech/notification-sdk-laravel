<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\SmsChannel;
use Notification\SDK\Payloads\SmsPayload;

class SmsBuilder
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
     * @param array $phoneNumbers
     * @return $this
     */
    public function setPhoneNumbers($phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
        return $this;
    }

    /**
     * @param string $phoneNumber
     * @return $this
     */
    public function addPhoneNumber($phoneNumber)
    {
        array_push($this->phoneNumbers, $phoneNumber);
        return $this;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return SmsChannel
     */
    public function build()
    {
        return new SmsChannel(new SmsPayload($this));
    }
}