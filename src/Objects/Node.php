<?php
/**
 * Copyright (c) 2019 - present
 * updown - Node.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 18/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractCollection;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\NodeFields;
use Biscolab\UpDown\Http\UpDownResponse;
use Biscolab\UpDown\Types\Nodes;
use Biscolab\UpDown\Types\Ssl;

/**
 * Class Check
 * @property string token
 * @property string url
 * @property int    period
 * @property float  apdex_t
 * @property bool   enabled
 * @property bool   published
 * @property string alias
 * @property string string_match
 * @property string mute_until
 * @property string http_verb
 * @property string http_body
 * @property array  disabled_locations
 * @property array  custom_headers
 * @property bool   down
 * @property int    down_since
 * @property int    last_status
 * @property string error
 * @property int    last_check_at
 * @property int    next_check_at
 * @property string favicon_url
 * @property Ssl    ssl
 * @package Biscolab\UpDown\Object
 */
class Node extends BaseObject
{

    /**
     * @var string
     */
    protected static $endpoint = 'nodes';

    /**
     * @var string
     */
    protected static $collection_type = Nodes::class;

    /**
     * @var string
     */
    protected static $key = 'name';

    /**
     * @var array
     */
    protected $typeCheck = [
        NodeFields::NAME         => UpDownFieldType::STRING,
        NodeFields::IP           => UpDownFieldType::STRING,
        NodeFields::IP6          => UpDownFieldType::STRING,
        NodeFields::CITY         => UpDownFieldType::STRING,
        NodeFields::COUNTRY      => UpDownFieldType::STRING,
        NodeFields::COUNTRY_CODE => UpDownFieldType::STRING,
        NodeFields::LAT          => UpDownFieldType::FLOAT,
        NodeFields::LNG          => UpDownFieldType::FLOAT
    ];

    /**
     * @return array
     */
    public function getIpV4(): array
    {

        $path = $this->prepareApiPath() . '/ipv4';

        $response = $this->updown->get($path);

        $data = $response->getResult()->getData();

        return $data;
    }

    /**
     * @return array
     */
    public function getIpV6(): array
    {

        $path = $this->prepareApiPath() . '/ipv6';

        $response = $this->updown->get($path);

        $data = $response->getResult()->getData();

        return $data;
    }

    /**
     * @param UpDownResponse $response
     *
     * @return mixed
     */
    protected function getCollection(UpDownResponse $response): AbstractCollection
    {

        $data = [];

        $result = $response->getResult()->getData();

        foreach ($result as $k => $v) {

            $node_data = array_merge($v, [
                NodeFields::NAME => $k
            ]);
            array_push($data, $node_data);
        }

        $collection_type = static::$collection_type;

        return new $collection_type($response->getResult()->getData());
    }

}