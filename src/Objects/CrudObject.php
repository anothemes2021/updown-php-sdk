<?php
/**
 * Copyright (c) 2019 - present
 * updown - CrudObject.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractCollection;
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
     * @var string
     */
    protected static $collection_type = '';

    /**
     * @var string
     */
    protected $key = '';

    /**
     * CrudObject constructor.
     *
     * @param mixed $args
     */
    public function __construct($args = [])
    {

        if (!is_array($args)) {
            $args_[self::getPrimaryKey()] = $args;
        } else {
            $args_ = $args;
        }

        parent::__construct($args_);
    }

    /**
     * @return string
     */
    public static function getPrimaryKey(): string
    {

        return 'token';
    }

    /**
     * @return null|AbstractCollection
     */
    public function all(): AbstractCollection
    {

        $path = static::getEndpoint();

        $response = $this->updown->get($path);

        if (static::$collection_type) {
            $collection_type = static::$collection_type;

            return new $collection_type($response->getResult()->getData());
        }

        return null;
    }

    /**
     * @return string
     */
    protected static function getEndpoint(): string
    {

        return UpDown::API_URL . static::$endpoint;
    }

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
     * @return mixed
     */
    public function getId()
    {

        return $this->{static::getPrimaryKey()};

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
     * @return string
     */
    public function getStaticEndpoint(): string
    {

        return static::getEndpoint();
    }

}