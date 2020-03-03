<?php

namespace Notification\SDK\Builder;

class MessageBuilder
{
    /**
     * @var FcmBuilder
     */
    private $fcmBuilder;

    /**
     * @param FcmBuilder $fcmBuilder
     * @return $this
     */
    public function setFcmBuilder($fcmBuilder)
    {
        $this->fcmBuilder = $fcmBuilder;
        return $this;
    }

    /**
     * @return FcmBuilder
     */
    public function getFcmBuilder()
    {
        return $this->fcmBuilder;
    }

    /**
     * @return MessagePayload
     */
    public function build()
    {
        return new MessagePayload($this);
    }
}