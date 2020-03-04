<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Payloads\FcmPayload;

class FcmBuilder
{
    /**
     * @var int
     */
    protected $notifiableId;

    /**
     * @var array|null
     */
    protected $content;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param mixed $id
     * @return $this
     */
    public function setNotifiableId($id)
    {
        $this->notifiableId = $id;
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
     * @return int
     */
    public function getNotifiableId()
    {
        return $this->notifiableId;
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
     * Build a FcmPayload.
     *
     * @return FcmPayload
     */
    public function build()
    {
        return new FcmPayload($this);
    }
}