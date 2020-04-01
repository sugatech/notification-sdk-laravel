<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\FcmTopicBuilder;

class FcmTopicPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $topics;

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