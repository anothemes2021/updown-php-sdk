<?php
/**
 * Copyright (c) 2018 - present
 * ipstack - UpDown.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 17/11/2018
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown;

use Biscolab\UpDown\Fields\UpDownRequestFields;
use Biscolab\UpDown\Http\UpDownClient;
use Biscolab\UpDown\Http\UpDownRequest;
use Biscolab\UpDown\Http\UpDownResponse;

/**
 * Class UpDown
 * @package Biscolab\UpDown\Abstracts
 */
class UpDown
{

    /**
     * UpDown
     *
     * @var UpDown
     */
    protected static $instance;

    /**
     * @var string
     */
    protected $result = '';

    /**
     * @var Api
     */
    protected $updown_api;

    /**
     * @var null|UpDownClient
     */
    protected $client = null;

    /**
     * @var string
     */
    protected $key = '';

    /**
     * @var string
     */
    const API_URL = "https://updown.io/api/";

    /**
     * Api constructor.
     *
     * @param array $config
     */
    public function __construct(array $config = [])
    {

        // Set "API key"
        $key = (empty($config[UpDownRequestFields::API_KEY])) ? '' : $config[UpDownRequestFields::API_KEY];
        $this->setKey($key);

        $this->setClient();
    }

    /**
     * @param $config
     *
     * @return UpDown
     */
    public static function init($config): UpDown
    {

        $updown = new static($config);
        static::setInstance($updown);

        return $updown;
    }

    /**
     * @param UpDown $instance
     */
    public static function setInstance(UpDown $instance)
    {

        static::$instance = $instance;
    }

    /**
     * @return UpDown
     */
    public static function instance(): UpDown
    {

        return static::$instance;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {

        return $this->key;
    }

    /**
     * @param string $key
     *
     * @return UpDown
     */
    public function setKey(string $key): UpDown
    {

        $this->key = $key;

        return $this;
    }

    /**
     * @return UpDownClient
     */
    public function getClient(): UpDownClient
    {

        return $this->client;
    }

    /**
     * @param UpDownClient|null $client
     *
     * @return UpDown
     */
    public function setClient(?UpDownClient $client = null): UpDown
    {

        $this->client = $client ?? new UpDownClient();

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceEndpoint(): string
    {

        return $this->updown_api->getServiceEndpoint();
    }

    /**
     * @param array $params
     *
     * @return mixed
     */
    public function createRequest(array $params): UpDownRequest
    {

        return new UpDownRequest($params);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return mixed
     */
    public function get(string $path, $params = []): UpDownResponse
    {

        return $this->client->get($path, $params);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return mixed
     */
    public function post(string $path, $params = []): UpDownResponse
    {

        return $this->client->post($path, $params);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return mixed
     */
    public function put(string $path, $params = []): UpDownResponse
    {

        return $this->client->put($path, $params);
    }

    /**
     * @param string $path
     * @param array  $params
     *
     * @return mixed
     */
    public function delete(string $path, $params = []): UpDownResponse
    {

        return $this->client->delete($path, $params);
    }

}