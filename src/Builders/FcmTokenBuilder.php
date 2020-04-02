<?php

namespace Notification\SDK\Builders;

use Notification\SDK\Channels\FcmTokenChannel;
use Notification\SDK\Payloads\FcmTokenPayload;

class FcmTokenBuilder
{
    /**
     * @var string[]
     */
    protected $tokens = [];

    /**
     * @var array|null
     */
    protected $content;

    /**
     * @var array|null
     */
    protected $data;

    /**
     * @param string[] $tokens
     * @return $this
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
        return $this;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function addToken($token)
    {
        $this->tokens[] = $token;
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
    public function getTokens()
    {
        return $this->tokens;
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
     * @return FcmTokenChannel
     */
    public function build()
    {
        return new FcmTokenChannel(new FcmTokenPayload($this));
    }
}