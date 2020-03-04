<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\FcmTopicBuilder;

class FcmTopicPayload implements Arrayable
{
    /**
     * @var string
     */
    protected $topic;

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

        $this->topic = $builder->getTopic();
        $this->content = $builder->getContent();
        $this->data = $builder->getData();
    }

    /**
     * convert FcmTopicPayload to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'topic' => $this->topic,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}