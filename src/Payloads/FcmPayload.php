<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
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
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('fcm', $notification)) {
            return;
        }

        if (is_array($to)) {
            array_merge($this->notifiableIds, $to);
        } else {
            $this->notifiableIds[] = $to;
        }
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