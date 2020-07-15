<?php

namespace Notification\SDK;

use PassportClientCredentials\OAuthClient;
use Zttp\PendingZttpRequest;
use Zttp\Zttp;
use Zttp\ZttpResponse;

class NotificationClient
{
    /**
     * @var OAuthClient
     */
    private $oauthClient;

    /**
     * @var string
     */
    private $apiUrl;

    /**
     * NotificationClient constructor.
     * @param string $apiUrl
     */
    public function __construct($apiUrl)
    {
        $this->oauthClient = new OAuthClient(
            config('notification.oauth.url'),
            config('notification.oauth.client_id'),
            config('notification.oauth.client_secret')
        );
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param callable $handler
     * @return ZttpResponse
     */
    private function request($handler)
    {
        $request = Zttp::withHeaders([
            'Authorization' => 'Bearer ' . $this->oauthClient->getAccessToken(),
        ])
            ->withoutVerifying();

        $response = $handler($request);

        if ($response->status() == 401) {
            $this->oauthClient->getAccessToken(true);
        }

        return $response;
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
        $params = [
            'channels' => $channels->toArray(),
            'background' => $background,
        ];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->asJson()
                ->post(
                    $this->getUrl('/message/send'), $params);
        })
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @param array $params
     * @return array[]
     */
    public function getMessages($notifiableId, $params = [])
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId, $params) {
            return $request->get(
                $this->getUrl('/database/'.$notifiableId.'/messages'),
                $params
            );
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return array
     */
    public function getMessage($notifiableId, $messageId)
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId, $messageId) {
            return $request->get($this->getUrl('/database/'.$notifiableId.'/messages/'.$messageId));
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return bool
     */
    public function markAsRead($notifiableId, $messageId)
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId, $messageId) {
            return $request->post($this->getUrl('/database/'.$notifiableId.'/messages/'.$messageId.'/read'));
        })
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return bool
     */
    public function markAsUnread($notifiableId, $messageId)
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId, $messageId) {
            return $request->post($this->getUrl('/database/'.$notifiableId.'/messages/'.$messageId.'/unread'));
        })
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @return bool
     */
    public function markAllRead($notifiableId)
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId) {
            return $request->post($this->getUrl('/database/'.$notifiableId.'/messages/read/all'));
        })
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @return int
     */
    public function countUnreadMessages($notifiableId)
    {
        return $this->request(function (PendingZttpRequest $request) use ($notifiableId) {
            return $request->get($this->getUrl('/database/'.$notifiableId.'/messages/unread/count'));
        })
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
        $params = [
            'notifiable_id' => $notifiableId,
            'token' => $token,
            'platform' => $platform,
            'topics' => $topics,
        ];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/token/register'), $params);
        })
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
        $params = [
            'notifiable_id' => $notifiableId,
            'token' => $token,
            'topics' => $topics,
        ];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->asJson()
                ->post(
                    $this->getUrl('/fcm/token/unregister'), $params);
        })
            ->isSuccess();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     */
    public function subscribeTopic($topics, $token)
    {
        $params = [
            'topics' => $topics,
            'token' => $token
        ];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/topics/subscribe'), $params);
        })
            ->isSuccess();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     */
    public function unsubscribeTopic($topics, $token)
    {
        $params = [
            'topics' => $topics,
            'tokens' => $token,
        ];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/topics/unsubscribe'), $params);
        })
            ->isSuccess();
    }

    /**
     * @param string $notifiableId
     * @param array $params
     * @return array|null
     */
    public function getTokens($notifiableId, $params = [])
    {
        $params[] = ['notifiable_id' => $notifiableId];

        return $this->request(function (PendingZttpRequest $request) use ($params) {
            return $request->get(
                $this->getUrl('/fcm'),
                $params
            );
        })
            ->json();
    }
}