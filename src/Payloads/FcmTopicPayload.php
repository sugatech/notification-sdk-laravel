<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
use Notification\SDK\Builders\FcmTopicBuilder;

class FcmTopicPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $topics = [];

    /**
     * @var null|array
     */
    protected $content;

    /**
     * @var null|array
     */
    protected $data;

    /**
     * FcmTopicPayload constructor.
     *
     * @param FcmTopicBuilder $builder
     */
    public function __construct(FcmTopicBuilder $builder)
    {

        $this->topics = $builder->getTopics();
        $this->content = $builder->getContent();
        $this->data = $builder->getData();
    }

    /**
     * @return string[]
     */
    public function getTo()
    {
        return $this->topics;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('topic', $notification)) {
            return;
        }

        if (is_array($to)) {
            array_merge($this->topics, $to);
        } else {
            $this->topics[] = $to;
        }
    }

    /**
     * convert FcmTopicPayload to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'topics' => $this->topics,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}