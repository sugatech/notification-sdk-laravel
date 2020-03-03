<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Payloads\FcmPayload;
use Notification\SDK\Payloads\MessagePayload;

class MessageBuilder
{
    /**
     * @var FcmPayload
     */
    private $fcmPayload;

    /**
     * @param FcmPayload $fcmPayload
     * @return $this
     */
    public function setFcmPayload($fcmPayload)
    {
        $this->fcmPayload = $fcmPayload;
        return $this;
    }

    /**
     * @return FcmPayload
     */
    public function getFcmPayload()
    {
        return $this->fcmPayload;
    }

    /**
     * @return MessagePayload
     */
    public function build()
    {
        return new MessagePayload($this);
    }
}