<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\FcmBuilder;

class FcmPayload extends Payload
{
    /**
     * @var array
     */
    protected $notifiableIds;

    /**
     * @var null|array
     */
    protected $data;

    /**
     * @var null|array
     */
    protected $content;

    /**
     * FcmPayload constructor.
     *
     * @param FcmBuilder $builder
     */
    public function __construct(FcmBuilder $builder)
    {
        $this->notifiableIds = $builder->getNotifiableIds();
        $this->content = $builder->getContent();
        $this->data = $builder->getData();
    }

    /**
     * convert FcmPayload to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'notifiable_ids' => $this->notifiableIds,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}