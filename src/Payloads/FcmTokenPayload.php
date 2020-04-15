<?php

namespace Notification\SDK\Payloads;

use Illuminate\Notifications\Notification;
use Notification\SDK\Builders\FcmTokenBuilder;

class FcmTokenPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $tokens = [];

    /**
     * @var null|array
     */
    protected $data;

    /**
     * @var null|array
     */
    protected $content;

    /**
     * FcmTokenPayload constructor.
     *
     * @param FcmTokenBuilder $builder
     */
    public function __construct(FcmTokenBuilder $builder)
    {

        $this->tokens = $builder->getTokens();
        $this->content = $builder->getContent();
        $this->data = $builder->getData();
    }

    /**
     * @return string[]
     */
    public function getTo()
    {
        return $this->tokens;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     */
    public function setTo($notifiable, $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('fcm_token', $notification)) {
            return;
        }

        if (is_array($to)) {
            array_merge($this->tokens, $to);
        } else {
            $this->tokens[] = $to;
        }
    }

    /**
     * convert FcmTokenPayload to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'tokens' => $this->tokens,
            'content' => $this->content,
            'data' => $this->data,
        ];
    }
}