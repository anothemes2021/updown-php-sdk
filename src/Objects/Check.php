<?php
/**
 * Copyright (c) 2019 - present
 * updown - Check.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\CheckFields;
use Biscolab\UpDown\Types\Checks;
use Biscolab\UpDown\Types\DownTimes;
use Biscolab\UpDown\Types\Metrics;
use Biscolab\UpDown\Types\Ssl;

/**
 * Class Check
 * @package Biscolab\UpDown\Object
 */
class Check extends CrudObject
{

    /**
     * @var string
     */
    protected static $endpoint = 'checks';

    /**
     * @var string
     */
    protected $key = 'token';

    /**
     * @var string
     */
    protected static $collection_type = Checks::class;

    /**
     * @var array
     */
    protected $typeCheck = [
        CheckFields::TOKEN              => UpDownFieldType::STRING,
        CheckFields::URL                => UpDownFieldType::STRING,
        CheckFields::URL                => UpDownFieldType::STRING,
        CheckFields::PERIOD             => UpDownFieldType::INT,
        CheckFields::APDEX_T            => UpDownFieldType::FLOAT,
        CheckFields::ENABLED            => UpDownFieldType::BOOL,
        CheckFields::PUBLISHED          => UpDownFieldType::BOOL,
        CheckFields::ALIAS              => UpDownFieldType::STRING,
        CheckFields::STRING_MATCH       => UpDownFieldType::STRING,
        CheckFields::MUTE_UNTIL         => UpDownFieldType::STRING,
        CheckFields::HTTP_VERB          => UpDownFieldType::STRING,
        CheckFields::HTTP_BODY          => UpDownFieldType::STRING,
        CheckFields::DISABLED_LOCATIONS => UpDownFieldType::ARRAY,
        CheckFields::CUSTOM_HEADERS     => UpDownFieldType::ARRAY,
        CheckFields::DOWN               => UpDownFieldType::BOOL,
        CheckFields::DOWN_SINCE         => UpDownFieldType::DATETIME,
        CheckFields::LAST_STATUS        => UpDownFieldType::INT,
        CheckFields::ERROR              => UpDownFieldType::STRING,
        CheckFields::LAST_CHECK_AT      => UpDownFieldType::DATETIME,
        CheckFields::NEXT_CHECK_AT      => UpDownFieldType::DATETIME,
        CheckFields::FAVICON_URL        => UpDownFieldType::STRING,
        CheckFields::SSL                => Ssl::class,
    ];

    /**
     * @param int|null    $from
     * @param int|null    $to
     * @param null|string $group
     *
     * @return Metrics
     */
    public function getMetrics(?int $from = null, ?int $to = null, ?string $group = null): Metrics
    {

        $path = $this->prepareApiPath() . '/metrics';

        $response = $this->updown->get($path, [
            'from' => ($from) ? date(DATE_ISO8601, $from) : $from,
            'to' => ($to) ? date(DATE_ISO8601, $to) : $to,
            'group' => $group,
        ]);

        return new Metrics($response->getResult()->getData());
    }

    /**
     * @param int $page
     *
     * @return DownTimes
     */
    public function getDowntimes($page = 1): DownTimes
    {

        $path = $this->prepareApiPath() . '/downtimes';

        $response = $this->updown->get($path, [
            'page' => $page
        ]);

        return new DownTimes($response->getResult()->getData());
    }

}