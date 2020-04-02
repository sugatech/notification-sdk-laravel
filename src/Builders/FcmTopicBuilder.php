<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\FcmTopicChannel;
use Notification\SDK\Payloads\FcmTopicPayload;

class FcmTopicBuilder
{
    /**
     * @var string[]
     */
    protected $topics = [];

    /**
     * @var array|null
     */
    protected $content;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param string[] $topics
     * @return $this
     */
    public function setTopics($topics)
    {
        $this->topics = $topics;
        return $this;
    }

    /**
     * @param string $topic
     * @return $this
     */
    public function addTopic($topic)
    {
        $this->topics[] = $topic;
        return $this;
    }

    /**
     * @param array $params ['title' => '', 'body' => '', 'sound' => '', 'icon' => '', 'click_action' => '']
     * @return $this
     */
    public function setContent(array $params)
    {
        $this->content = $params;
        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getTopics()
    {
        return $this->topics;
    }

    /**
     * @return array|null
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return array|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return FcmTopicChannel
     */
    public function build()
    {
        return new FcmTopicChannel(new FcmTopicPayload($this));
    }
}