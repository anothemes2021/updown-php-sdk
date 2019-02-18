<?php
/**
 * Copyright (c) 2019 - present
 * updown - Eventhp
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 18/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\WebHookFields;
use Biscolab\UpDown\Types\WebHooks;

/**
 * Event Node
 * @property string id
 * @property string url
 * @package Biscolab\UpDown\Object
 */
class WebHook extends CrudObject
{

    /**
     * @var string
     */
    protected static $endpoint = 'webhooks';

    /**
     * @var string
     */
    protected static $collection_type = WebHooks::class;

    /**
     * @var string
     */
    protected static $key = WebHookFields::ID;

    /**
     * @var array
     */
    protected $typeCheck = [
        WebHookFields::ID  => UpDownFieldType::STRING,
        WebHookFields::URL => UpDownFieldType::STRING,
    ];

    /**
     * @return AbstractObject
     * @throws \Exception
     */
    public function read(): AbstractObject
    {

        throw new \Exception(__CLASS__ . ' doesn not have ' . __METHOD__ . ' method');
    }

    /**
     * @param array|null $params
     *
     * @return AbstractObject
     * @throws \Exception
     */
    public function update(?array $params = []): AbstractObject
    {

        throw new \Exception(__CLASS__ . ' doesn not have ' . __METHOD__ . ' method');
    }

}