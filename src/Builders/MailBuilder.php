<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\MailChannel;
use Notification\SDK\Payloads\MailPayload;

class MailBuilder
{
    /**
     * @var string[]
     */
    protected $emails = [];

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param array $emails
     * @return $this
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;
        return $this;
    }

    /**
     * @param string $email
     * @return $this
     */
    public function addEmail($email)
    {
        $this->emails[] = $email;
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
    public function getEmails()
    {
        return $this->emails;
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