<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Payloads\DatabasePayload;
use Notification\SDK\Payloads\FcmPayload;
use Notification\SDK\Payloads\FcmTokenPayload;
use Notification\SDK\Payloads\FcmTopicPayload;
use Notification\SDK\Payloads\MailPayload;
use Notification\SDK\Payloads\MessagePayload;
use Notification\SDK\Payloads\SmsPayload;

class MessageBuilder
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
     * @return DatabasePayload
     */
    public function getDatabasePayload()
    {
        return $this->databasePayload;
    }

    /**
     * @param DatabasePayload $databasePayload
     * @return MessageBuilder
     */
    public function setDatabasePayload($databasePayload)
    {
        $this->databasePayload = $databasePayload;
        return $this;
    }

    /**
     * @return MailPayload
     */
    public function getMailPayload()
    {
        return $this->mailPayload;
    }

    /**
     * @param MailPayload $mailPayload
     * @return MessageBuilder
     */
    public function setMailPayload($mailPayload)
    {
        $this->mailPayload = $mailPayload;
        return $this;
    }

    /**
     * @return SmsPayload
     */
    public function getSmsPayload()
    {
        return $this->smsPayload;
    }

    /**
     * @param SmsPayload $smsPayload
     * @return MessageBuilder
     */
    public function setSmsPayload($smsPayload)
    {
        $this->smsPayload = $smsPayload;
        return $this;
    }

    /**
     * @return FcmTokenPayload
     */
    public function getFcmTokenPayload()
    {
        return $this->fcmTokenPayload;
    }

    /**
     * @param FcmTokenPayload $fcmTokenPayload
     * @return MessageBuilder
     */
    public function setFcmTokenPayload($fcmTokenPayload)
    {
        $this->fcmTokenPayload = $fcmTokenPayload;
        return $this;
    }

    /**
     * @return FcmTopicPayload
     */
    public function getFcmTopicPayload()
    {
        return $this->fcmTopicPayload;
    }

    /**
     * @param FcmTopicPayload $fcmTopicPayload
     * @return MessageBuilder
     */
    public function setFcmTopicPayload($fcmTopicPayload)
    {
        $this->fcmTopicPayload = $fcmTopicPayload;
        return $this;
    }

    /**
     * @return MessagePayload
     */
    public function build()
    {
        return new MessagePayload($this);
    }
}