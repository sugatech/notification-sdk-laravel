<?php

namespace Notification\SDK\Payloads;

use Notification\SDK\Builders\FcmTokenBuilder;

class FcmTokenPayload extends Payload
{
    /**
     * @var string[]
     */
    protected $tokens;

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