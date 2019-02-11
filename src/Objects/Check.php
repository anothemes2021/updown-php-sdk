<?php
/**
 * Copyright (c) 2019 - present
 * updown - Check.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 8/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\CheckFields;

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
    ];

}