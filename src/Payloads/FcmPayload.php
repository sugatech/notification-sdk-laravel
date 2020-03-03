<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\FcmBuilder;

class FcmPayload implements Arrayable
{
    /**
     * @var int
     */
    protected $notifiableId;

    /**
     * @var null|array
     */
    protected $data;

    /**
     * @var null|array
     */
    protected $content;

    /**
     * FcmBuilder constructor.
     *
     * @param FcmBuilder $builder
     */
    public function __construct(FcmBuilder $builder)
    {

        $this->notifiableId = $builder->getNotifiableId();
        $this->content = $builder->getContent();
        $this->data = $builder->getData();
    }

    /**
     * convert FcmBuilder to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'notifiable_id' => $this->notifiableId,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}