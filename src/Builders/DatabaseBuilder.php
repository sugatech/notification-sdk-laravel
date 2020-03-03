<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Payloads\DatabasePayload;

class DatabaseBuilder
{
    /**
     * @var int
     */
    protected $notifiableId;

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
     * @param array $data
     * @return $this
     */
    public function setData($data)
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
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Build an FcmBuilder.
     *
     * @return DatabasePayload
     */
    public function build()
    {
        return new DatabasePayload($this);
    }
}