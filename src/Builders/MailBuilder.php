<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\MailChannel;
use Notification\SDK\Payloads\MailPayload;

class MailBuilder
{
    /**
     * @var string[]
     */
    protected $mails = [];

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param array $mails
     * @return $this
     */
    public function setMails($mails)
    {
        $this->mails = $mails;
        return $this;
    }

    /**
     * @param string $mail
     * @return $this
     */
    public function addMail($mail)
    {
        $this->mails[] = $mail;
        return $this;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
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
    public function getMails()
    {
        return $this->mails;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Build a MailPayload.
     *
     * @return MailChannel
     */
    public function build()
    {
        return new MailChannel(new MailPayload($this));
    }
}