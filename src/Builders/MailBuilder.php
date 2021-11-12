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
     * @var string
     */
    protected $contentType;

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
     * @param string $contentType
     * @return $this
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
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
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
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