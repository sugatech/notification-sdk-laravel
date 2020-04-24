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
     * @param bool $background
     * @return bool
     */
    public function send($channels, $background = true)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/message/send'),
                [
                    'channels' => $channels->toArray(),
                    'background' => $background,
                ])
            ->isSuccess();
    }

    /**
     * @param array $params
     * @return array[]
     */
    public function getMessages($params = [])
    {
        return $this->request()
            ->get(
                $this->getUrl('/database/messages'),
                $params
            )
            ->json();
    }

    /**
     * @param int $messageId
     * @return array
     */
    public function getMessage($messageId)
    {
        return $this->request()
            ->get($this->getUrl('/database/messages/'.$messageId))
            ->json();
    }

    /**
     * @param int $messageId
     * @return bool
     */
    public function markAsRead($messageId)
    {
        return $this->request()
            ->post($this->getUrl('/database/messages/'.$messageId.'/read'))
            ->isSuccess();
    }

    /**
     * @param int $messageId
     * @return bool
     */
    public function markAsUnread($messageId)
    {
        return $this->request()
            ->post($this->getUrl('/database/messages/'.$messageId.'/unread'))
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @return int
     */
    public function countUnreadMessages($notifiableId)
    {
        return $this->request()
            ->get($this->getUrl('/database/messages/unread/count'),
                [
                    'notifiable_id' => $notifiableId,
                ]
            )
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param string $token
     * @param string $platform
     * @param null|string[] $topics
     * @return bool
     */
    public function registerFcmToken($notifiableId, $token, $platform, $topics = null)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/token/register'),
                [
                    'notifiable_id' => $notifiableId,
                    'token' => $token,
                    'platform' => $platform,
                    'topics' => $topics,
                ]
            )
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @param string $token
     * @param null|string[] $topics
     * @return bool
     */
    public function unregisterFcmToken($notifiableId, $token, $topics = null)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/token/unregister'),
                [
                    'notifiable_id' => $notifiableId,
                    'token' => $token,
                    'topics' => $topics,
                ]
            )
            ->isSuccess();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     */
    public function subscribeTopic($topics, $token)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/topics/subscribe'),
                [
                    'topics' => $topics,
                    'token' => $token
                ]
            )
            ->isSuccess();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     */
    public function unsubscribeTopic($topics, $token)
    {
        return $this->request()
            ->asJson()
            ->post(
                $this->getUrl('/fcm/topics/unsubscribe'),
                [
                    'topics' => $topics,
                    'tokens' => $token,
                ]
            )
            ->isSuccess();
    }
}