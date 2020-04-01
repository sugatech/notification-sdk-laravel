<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\FcmChannel;
use Notification\SDK\Payloads\FcmPayload;

class FcmBuilder
{
    /**
     * @var array
     */
    protected $notifiableIds;

    /**
     * @var array|null
     */
    protected $content;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param int|string|array $id
     * @return $this
     */
    public function setNotifiableIds($id)
    {
        if (is_array($id)) {
            array_merge($this->notifiableIds, $id);
        } else {
            array_push($this->notifiableIds, $id);
        }

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
     * @return array
     */
    public function getNotifiableIds()
    {
        return $this->notifiableIds;
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
     * @return FcmChannel
     */
    public function build()
    {
        return new FcmChannel(new FcmPayload($this));
    }
}