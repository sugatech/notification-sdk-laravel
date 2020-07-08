<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\MailBuilder;

class MailPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $emails;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * MailPayload constructor.
     * @param MailBuilder $mailBuilder
     */
    public function __construct($mailBuilder)
    {
        $this->emails = $mailBuilder->getEmails();
        $this->title = $mailBuilder->getTitle();
        $this->content = $mailBuilder->getContent();
    }

    /**
     * @return string[]
     */
    public function getTo()
    {
        return $this->emails;
    }

    /**
     * @param string|string[] $to
     */
    public function setTo($to)
    {
        $this->emails = is_array($to) ? $to : [$to];
    }

    /**
     * convert MailPayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'emails' => $this->emails,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}