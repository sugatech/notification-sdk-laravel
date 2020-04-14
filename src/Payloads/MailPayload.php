<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
use Notification\SDK\Builders\MailBuilder;

class MailPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $mails;

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
        $this->mails = $mailBuilder->getMails();
        $this->title = $mailBuilder->getTitle();
        $this->content = $mailBuilder->getContent();
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('mail', $notification)) {
            return;
        }

        if (is_array($to)) {
            array_merge($this->mails, $to);
        } else {
            $this->mails[] = $to;
        }
    }

    /**
     * convert MailPayload to array
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'mails' => $this->mails,
            'title' => $this->title,
            'content' => $this->content,
        ];
    }
}