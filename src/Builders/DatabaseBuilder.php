<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\DatabaseChannel;
use Notification\SDK\Payloads\DatabasePayload;

class DatabaseBuilder
{
    /**
     * @var array
     */
    protected $notifiableIds = [];

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param array $ids
     * @return $this
     */
    public function setNotifiableIds($ids)
    {
        $this->notifiableIds = $ids;
        return $this;
    }

    /**
     * @param string $id
     * @return $this
     */
    public function addNotifiableId($id)
    {
        $this->notifiableIds[] = $id;
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
     * @return array
     */
    public function getNotifiableIds()
    {
        return $this->notifiableIds;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return DatabaseChannel
     */
    public function build()
    {
        return new DatabaseChannel(new DatabasePayload($this));
    }
}