<?php

namespace Notification\SDK;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use OAuth2ClientCredentials\OAuthClient;

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
     * @return Response
     * @throws \Illuminate\Http\Client\RequestException
     */
    private function request($handler)
    {
        $request = Http::withHeaders([
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
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function send($channels, $background = true)
    {
        $params = [
            'channels' => $channels->toArray(),
            'background' => $background,
        ];

        return $this->request(function (PendingRequest $request) use ($params) {
            return $request->asJson()
                ->post(
                    $this->getUrl('/message/send'), $params);
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @param array $params
     * @return array[]
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getMessages($notifiableId, $params = [])
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId, $params) {
            return $request->get(
                $this->getUrl('/database/' . $notifiableId . '/messages'),
                $params
            );
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getMessage($notifiableId, $messageId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId, $messageId) {
            return $request->get($this->getUrl('/database/' . $notifiableId . '/messages/' . $messageId));
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function markAsRead($notifiableId, $messageId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId, $messageId) {
            return $request->post($this->getUrl('/database/' . $notifiableId . '/messages/' . $messageId . '/read'));
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @param int $messageId
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function markAsUnread($notifiableId, $messageId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId, $messageId) {
            return $request->post($this->getUrl('/database/' . $notifiableId . '/messages/' . $messageId . '/unread'));
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function markAllRead($notifiableId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId) {
            return $request->post($this->getUrl('/database/' . $notifiableId . '/messages/read/all'));
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @return int
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function countUnreadMessages($notifiableId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId) {
            return $request->get($this->getUrl('/database/' . $notifiableId . '/messages/unread/count'));
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param string $token
     * @param string $platform
     * @param null|string[] $topics
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function registerFcmToken($notifiableId, $token, $platform, $topics = null)
    {
        $params = [
            'notifiable_id' => $notifiableId,
            'token' => $token,
            'platform' => $platform,
            'topics' => $topics,
        ];

        return $this->request(function (PendingRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/token/register'), $params);
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @param string $token
     * @param null|string[] $topics
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function unregisterFcmToken($notifiableId, $token, $topics = null)
    {
        $params = [
            'notifiable_id' => $notifiableId,
            'token' => $token,
            'topics' => $topics,
        ];

        return $this->request(function (PendingRequest $request) use ($params) {
            return $request->asJson()
                ->post(
                    $this->getUrl('/fcm/token/unregister'), $params);
        })
            ->successful();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function subscribeTopic($topics, $token)
    {
        $params = [
            'topics' => $topics,
            'token' => $token
        ];

        return $this->request(function (PendingRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/topics/subscribe'), $params);
        })
            ->successful();
    }

    /**
     * @param string[] $topics
     * @param string $token
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function unsubscribeTopic($topics, $token)
    {
        $params = [
            'topics' => $topics,
            'tokens' => $token,
        ];

        return $this->request(function (PendingRequest $request) use ($params) {
            return $request->asJson()
                ->post($this->getUrl('/fcm/topics/unsubscribe'), $params);
        })
            ->successful();
    }

    /**
     * @param string $notifiableId
     * @return array
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function getTokens($notifiableId)
    {
        return $this->request(function (PendingRequest $request) use ($notifiableId) {
            return $request->get($this->getUrl('/fcm/' . $notifiableId));
        })
            ->json();
    }

    /**
     * @param string $notifiableId
     * @param null|string[] $topics
     * @return bool
     * @throws \Illuminate\Http\Client\RequestException
     */
    public function removeFcmTokens($notifiableId, $topics = null)
    {
        $params = [
            'topics' => $topics,
        ];

        return $this->request(function (PendingRequest $request) use ($params, $notifiableId) {
            return $request->asJson()
                ->post($this->getUrl(sprintf('/fcm/%s/tokens/unregister', $notifiableId)), $params);
        })
            ->successful();
    }
}
