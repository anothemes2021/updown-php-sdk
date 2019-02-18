<?php
/**
 * Copyright (c) 2019 - present
 * updown - BaseObject.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 18/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractCollection;
use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Http\UpDownResponse;
use Biscolab\UpDown\UpDown;

/**
 * Class BaseObject
 * @package Biscolab\UpDown\BaseObject
 */
class BaseObject extends AbstractObject
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
    protected static $key = '';

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

        return static::$key;
    }

    /**
     * @return null|AbstractCollection
     */
    public function all(): AbstractCollection
    {

        $path = static::getEndpoint();

        $response = $this->updown->get($path);

        if (static::$collection_type) {

            return $this->getCollection($response);
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
     * @param UpDownResponse $response
     *
     * @return mixed
     */
    protected function getCollection(UpDownResponse $response): AbstractCollection
    {

        $collection_type = static::$collection_type;

        return new $collection_type($response->getResult()->getData());
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
     * @return string
     */
    public function getStaticEndpoint(): string
    {

        return static::getEndpoint();
    }

}