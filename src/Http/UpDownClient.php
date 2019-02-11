<?php
/**
 * Copyright (c) 2018 - present
 * ipstack - UpDownClient.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 17/11/2018
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Http;

use Biscolab\UpDown\Enum\UpDownRequestMethod;
use Biscolab\UpDown\Fields\UpDownRequestFields;
use Biscolab\UpDown\UpDown;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class UpDownClient
{

    /**
     * @var Client
     */
    protected $client = null;

    /**
     * GeocoderClient constructor.
     */
    public function __construct()
    {

        $this->setClient(new Client());
    }

    /**
     * @param null $client
     *
     * @return UpDownClient
     */
    public function setClient($client)
    {

        $this->client = $client;

        return $this;
    }

    /**
     * @param string     $url
     * @param array|null $params
     *
     * @return UpDownResponse
     */
    public function get(string $url, ?array $params = null): UpDownResponse
    {

        return $this->makeCall(UpDownRequestMethod::GET, $url, $params);

    }

    public function makeCall(string $method, string $url, array $params = [])
    {

        $client_params = [];
        $query_params = [];

        switch ($method) {
            case UpDownRequestMethod::POST:
            case UpDownRequestMethod::PUT:

                if (!empty($params[UpDownRequestFields::API_KEY])) {
                    $client_params['headers'] = [
                        'X-Api-Key' => $params[UpDownRequestFields::API_KEY],
                    ];
                }
                $client_params['form_params'] = $params;
                break;
            default:
                $query_params = $params;

        }
        $url .= '?' . http_build_query($this->addApiKeyToParams($query_params));
//        var_dump($client_params);exit;
        /** @var Response $res */
        $res = $this->client->request(strtoupper($method), $url, $client_params);

        return new UpDownResponse($res);
    }

    /**
     * @param array $params
     *
     * @return array
     */
    protected function addApiKeyToParams(array $params = []): array
    {

        $params[UpDownRequestFields::API_KEY] = UpDown::instance()->getKey();

        return $params;
    }

    /**
     * @param string     $url
     * @param array|null $params
     *
     * @return UpDownResponse
     */
    public function post(string $url, ?array $params = null): UpDownResponse
    {

        return $this->makeCall(UpDownRequestMethod::POST, $url, $params);

    }

    /**
     * @param string     $url
     * @param array|null $params
     *
     * @return UpDownResponse
     */
    public function put(string $url, ?array $params = null): UpDownResponse
    {

        return $this->makeCall(UpDownRequestMethod::PUT, $url, $params);

    }

    /**
     * @param string     $url
     * @param array|null $params
     *
     * @return UpDownResponse
     */
    public function delete(string $url, ?array $params = null): UpDownResponse
    {

        return $this->makeCall(UpDownRequestMethod::DELETE, $url, $params);
    }
}