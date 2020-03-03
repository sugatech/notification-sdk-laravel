<?php

namespace Notification\SDK\Payloads;

use Illuminate\Contracts\Support\Arrayable;
use Notification\SDK\Builders\FcmBuilder;

class FcmPayload implements Arrayable
{
    /**
     * @internal
     *
     * @var null|string
     */
    protected $title;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $body;

    /**
     * @internal
     *
     * @var null/string
     */
    protected $channelId;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $icon;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $sound;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $badge;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $tag;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $color;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $clickAction;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $bodyLocationArgs;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationKey;

    /**
     * @internal
     *
     * @var null|string
     */
    protected $titleLocationArgs;

    /**
     * @var int
     */
    protected $notifiableId;

    /**
     * @var null|array
     */
    protected $data;

    /**
     * PayloadNotification constructor.
     *
     * @param FcmBuilder $builder
     */
    public function __construct(FcmBuilder $builder)
    {
        $this->title = $builder->getTitle();
        $this->body = $builder->getBody();
        $this->channelId = $builder->getChannelId();
        $this->icon = $builder->getIcon();
        $this->sound = $builder->getSound();
        $this->badge = $builder->getBadge();
        $this->tag = $builder->getTag();
        $this->color = $builder->getColor();
        $this->clickAction = $builder->getClickAction();
        $this->bodyLocationKey = $builder->getBodyLocationKey();
        $this->bodyLocationArgs = $builder->getBodyLocationArgs();
        $this->titleLocationKey = $builder->getTitleLocationKey();
        $this->titleLocationArgs = $builder->getTitleLocationArgs();
        $this->notifiableId = $builder->getNotifiableId();
        $this->data = $builder->getData();
    }

    /**
     * convert PayloadNotification to array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'notifiable_id' => $this->notifiableId,
            'content' => [
                'title' => $this->title,
                'body' => $this->body,
                'android_channel_id' => $this->channelId,
                'icon' => $this->icon,
                'sound' => $this->sound,
                'badge' => $this->badge,
                'tag' => $this->tag,
                'color' => $this->color,
                'click_action' => $this->clickAction,
                'body_loc_key' => $this->bodyLocationKey,
                'body_loc_args' => $this->bodyLocationArgs,
                'title_loc_key' => $this->titleLocationKey,
                'title_loc_args' => $this->titleLocationArgs,
            ],
            'data' => $this->data,
        ];
    }
}