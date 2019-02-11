<?php
/**
 * Copyright (c) 2019 - present
 * updown - CrudObject.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 11/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\UpDown;

/**
 * Class CrudObject
 * @package Biscolab\UpDown\Abstracts
 */
class CrudObject extends AbstractObject
{

    /**
     * @var string
     */
    protected static $endpoint = '';

    /**
     * @param array|null $params
     *
     * @return AbstractObject
     */
    public function create(?array $params = []): AbstractObject
    {

        if (empty($params)) {
            $params = $this->attributes;
        }

        $path = $this->prepareApiPath(false);

        $response = $this->updown->post($path, $params);

        $this->setArgs($response->getResult()->getData());

        return $this;
    }

    /**
     * @return string
     */
    protected static function getEndpoint(): string
    {

        return UpDown::API_URL . static::$endpoint;
    }

    /**
     * @return AbstractObject
     */
    public function read(): AbstractObject
    {

        $path = $this->prepareApiPath();

        $response = $this->updown->get($path);

        $this->setArgs($response->getResult()->getData());

        return $this;
    }

    /**
     * @param $params
     *
     * @return AbstractObject
     */
    public function update(?array $params = []): AbstractObject
    {

        if (empty($params)) {
            $params = $this->attributes;
            $this->setArgs($params);
        }

        $path = $this->prepareApiPath();

        $response = $this->updown->put($path, $params);

        $this->setArgs($response->getResult()->getData());

        return $this;
    }

    /**
     * @return bool
     */
    public function delete(): bool
    {

        $path = $this->prepareApiPath();

        $response = $this->updown->delete($path);

        $result = $response->getResult()->getData();

        if ($result['deleted']) {
            return $result['deleted'];
        }

        return false;
    }

    /**
     * @param bool|null $with_id
     *
     * @return string
     */
    public function prepareApiPath(?bool $with_id = true): string
    {

        $path = static::getEndpoint();

        if ($with_id) {
            $path .= '/' . $this->getId();
        }

        return $path;
    }

    /**
     * @return string
     */
    public function getStaticEndpoint(): string
    {

        return static::getEndpoint();
    }

}