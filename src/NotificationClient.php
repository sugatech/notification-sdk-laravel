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
}