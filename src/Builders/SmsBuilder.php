<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\SmsChannel;
use Notification\SDK\Payloads\SmsPayload;

class SmsBuilder
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
     * @param string $phoneNumber
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
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