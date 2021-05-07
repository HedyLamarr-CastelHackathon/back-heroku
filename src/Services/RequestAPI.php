<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Services\Constant\Constant;



/**
 * @author Cyril Vassallo
 * @version 1.0
 * This class manage HTTP requests to API's
 */
class RequestAPI
{
    private $client;
    private $domain;
    private $method;
    private $resource;
    private $payload;
    private $resourceId;
    public $response;

    /**
     * Constructor initialize property default values 
     */
    public function __construct()
    {
        $this->domain = Constant::get('fullApiGovDomain');
        $this->resource = null;
        $this->resourceId = null;
        $this->response = null;
        $this->payload = null;
        $this->client = new Client([
            'base_uri' => $this->domain,
        ]);
    }

    public function __destruct()
    {
        unset($this->client);
    }

    /**
     * Setters and Getters 
     * Setters can be chain DESIGN PATTERN cause they return the current instance
     */
    public function setMethod(string $method)
    {
        $this->method = $method;
        return $this;
    }

    public function setResource(string $resource)
    {
        $this->resource = $resource;
        return $this;
    }

    public function setResourceId(string $resourceId)
    {
        $this->resourceId = $resourceId;
        return $this;
    }

    public function setPayload(array $payload)
    {
        $this->payload = $payload;
        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }


    public function setCallbackParameters(array $extraParameterForCallback)
    {
        $this->$extraParameterForCallback = $extraParameterForCallback;
        return $this;
    }


    public function resetDomain($domain)
    {
        $this->domain = $domain;
        $this->client = new Client([
            'base_uri' => $this->domain,
        ]);
     
    }

    /**
     * Switch selector when send() is called
     *
     * @param callable $callback
     * @return void
     */
    public function send(callable $callback = null)
    {
        $method = strtolower($this->method);
        if ($method === 'get') {
            $this->get();
        } else if ($method === 'post') {
            $this->post();
        } else if ($method === 'put') {
            $this->put();
        }
    }


    /**
     * Register on element
     *
     * @return void
     */
    private function post()
    {
        $response = $this->client->post(
            $this->resource,
            ['json' => $this->payload]
        );
        $this->response = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get one or more element 
     * case one element resourceId has must be settled
     *
     * @return void
     */
    private function get()
    {
        $response = $this->client->get($this->resource);
     
        $this->response = json_decode($response->getBody()->getContents(), true);
    }


    /**
     * Update one element 
     * resourceId has to be settle
     *
     * @return void
     */
    private function put()
    {
        $response = $this->client->put(
            $this->resource . '/' . $this->resourceId,
            ['json' => $this->payload]
        );
        $this->response = json_decode($response->getBody()->getContents(), true);
    }
}
