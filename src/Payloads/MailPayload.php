<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\MailBuilder;

class MailPayload implements Arrayable
{
    /**
     * @var string
     */
    protected $mail;

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
        $this->mail = $mailBuilder->getMail();
        $this->title = $mailBuilder->getTitle();
        $this->content = $mailBuilder->getContent();
    }

    /**
     * convert MailPayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'mail' => $this->mail,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}