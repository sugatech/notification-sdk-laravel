<?php

namespace Notification\SDK;

use Zttp\PendingZttpRequest;
use Zttp\Zttp;

class NotificationClient
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * NotificationClient constructor.
     * @param string $apiUrl
     * @param string $accessToken
     */
    public function __construct($apiUrl, $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return PendingZttpRequest
     */
    private function request()
    {
        return Zttp::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ])
            ->withoutVerifying();
    }

    /**
     * @param string $route
     * @return string
     */
    private function getUrl($route)
    {
        return $this->apiUrl . '/api/client/v1' . $route;
    }

    /**
     * @param ChannelCollection $channels
     * @return bool
     */
    public function send($channels)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/message/send'),
                [
                    'channels' => $channels->toArray(),
                ])
            ->isSuccess();
    }

    /**
     * @param array $params
     * @return object[]
     */
    public function getMessages($params = [])
    {
        return $this->request()
            ->asJson()
            ->get(
                $this->getUrl('/database/messages'),
                $params
            )
            ->body();
    }

    /**
     * @param int $messageId
     * @return bool
     */
    public function markAsRead($messageId)
    {
        return $this->request()
            ->asJson()
            ->post($this->getUrl('/database/messages/'.$messageId.'/read'))
            ->isSuccess();
    }

    /**
     * @param int $notifiableId
     * @param string $token
     * @param string $platform
     * @param null|string $topic
     * @return bool
     */
    public function registerFcmToken($notifiableId, $token, $platform, $topic = null)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/token/register'),
                [
                    'notifiable_id' => $notifiableId,
                    'token' => $token,
                    'platform' => $platform,
                    'topic' => $topic,
                ]
            )
            ->isSuccess();
    }

    /**
     * @param int $notifiableId
     * @param string $token
     * @param null|string $topic
     * @return bool
     */
    public function unregisterFcmToken($notifiableId, $token, $topic = null)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/token/unregister'),
                [
                    'notifiable_id' => $notifiableId,
                    'token' => $token,
                    'topic' => $topic,
                ]
            )
            ->isSuccess();
    }

    /**
     * @param string $topic
     * @param string|string[] $tokens
     * @return bool
     */
    public function subscribeTopic($topic, $tokens)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/subscribe/topic'),
                [
                    'topic' => $topic,
                    'tokens' => $tokens
                ]
            )
            ->isSuccess();
    }

    /**
     * @param string $topic
     * @param string|string[] $tokens
     * @return bool
     */
    public function unsubscribeTopic($topic, $tokens)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/unsubscribe/topic'),
                [
                    'topic' => $topic,
                    'tokens' => $tokens,
                ]
            )
            ->isSuccess();
    }
}