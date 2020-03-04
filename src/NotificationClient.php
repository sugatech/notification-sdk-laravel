<?php

namespace Notification\SDK;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Notification\SDK\Builders\MessageBuilder;
use Psr\Http\Message\StreamInterface;

class NotificationClient
{
    /**
     * @var Client
     */
    private $client;

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
     * @param Client $client
     * @param string $apiUrl
     * @param string $accessToken
     */
    public function __construct($client, $apiUrl, $accessToken)
    {
        $this->client = $client;
        $this->accessToken = $accessToken;
        $this->apiUrl = $apiUrl;
    }

    /**
     * @param MessageBuilder $message
     * @return StreamInterface
     */
    public function send($message)
    {
        $response = $this->client->post($this->apiUrl.'/api/client/v1/message/send', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->accessToken,
            ],
            RequestOptions::JSON => [
                'channels' => $message->build(),
            ]
        ]);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param array $params
     * @return StreamInterface
     */
    public function getMessages($params = [])
    {
        $response = $this->client->get($this->apiUrl.'/api/client/v1/database/messages', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->accessToken,
            ],
            RequestOptions::JSON => $params
        ]);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $messageId
     * @return mixed
     */
    public function markAsRead($messageId)
    {
        $response = $this->client->post($this->apiUrl.'/api/client/v1/database/messages/'.$messageId.'/read', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->accessToken,
            ],
        ]);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $notifiableId
     * @param string $token
     * @param string $platform
     * @return mixed
     */
    public function registerFcmToken($notifiableId, $token, $platform)
    {
        $response = $this->client->post($this->apiUrl.'/api/client/v1/fcm/token/register', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->accessToken,
            ],
            RequestOptions::JSON => [
                'notifiable_id' => $notifiableId,
                'token' => $token,
                'platform' => $platform,
            ]
        ]);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param int $notifiableId
     * @param string $token
     * @return mixed
     */
    public function unregisterFcmToken($notifiableId, $token)
    {
        $response = $this->client->post($this->apiUrl.'/api/client/v1/fcm/token/unregister', [
            RequestOptions::HEADERS => [
                'Content-Type' => 'application/json',
                'Authorization' => $this->accessToken,
            ],
            RequestOptions::JSON => [
                'notifiable_id' => $notifiableId,
                'token' => $token,
            ]
        ]);

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}