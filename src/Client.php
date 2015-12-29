<?php
namespace Bacanu\BlWrap;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Subscriber\Oauth\Oauth1;

class Client
{
    private $client;
    private $stack;
    private $baseUrl = 'https://api.bricklink.com/api/store/v1/';

    private $consumerKey;
    private $consumerSecret;

    private $tokenValue;
    private $tokenSecret;

    public function __construct(array $config, ClientInterface $client = null, HandlerStack $stack = null)
    {
        $this->consumerKey = $config['consumerKey'];
        $this->consumerSecret = $config['consumerSecret'];
        $this->tokenValue = $config['tokenValue'];
        $this->tokenSecret = $config['tokenSecret'];

        if($stack) {
            $this->stack = $stack;
        } else {
            $this->stack = HandlerStack::create();

            $middleware = new Oauth1([
                'consumer_key' => $this->consumerKey,
                'consumer_secret' => $this->consumerSecret,
                'token' => $this->tokenValue,
                'token_secret' => $this->tokenSecret
            ]);
            $this->stack->push($middleware);
        }


        if($client){
            $this->client = $client;
        } else {
            $this->client = new \GuzzleHttp\Client([
                'base_uri' => $this->baseUrl,
                'handler' => $this->stack,
                'auth' => 'oauth'
            ]);
        }
    }

    /**
     * @param $method
     * @param $endpoint
     * @param array $body
     * @return mixed
     */
    public function execute($method, $endpoint, $body = [])
    {
        if (strtolower($method) == 'get') {
            $toSend = [
                "query" => $body
            ];
        } else {
            $toSend = [
                "json" => $body
            ];
        }

        $res = $this->client->{$method}($endpoint, $toSend);

        $data = $res->getBody()->getContents();

        return $data;
    }

}
