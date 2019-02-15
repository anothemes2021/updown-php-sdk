<?php
/**
 * Copyright (c) 2019 - present
 * updown - Requests.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\RequestsFields;

/**
 * Class Requests
 * @property int   samples
 * @property int   failures
 * @property int   satisfied
 * @property int   tolerated
 * @property array by_response_time
 * @package Biscolab\UpDown\Types
 */
class Requests extends AbstractObject
{

    /**
     * @var ARRAY
     */
    protected $typeCheck = [
        RequestsFields::SAMPLES          => UpDownFieldType::INT,
        RequestsFields::FAILURES         => UpDownFieldType::INT,
        RequestsFields::SATISFIED        => UpDownFieldType::INT,
        RequestsFields::TOLERATED        => UpDownFieldType::INT,
        RequestsFields::BY_RESPONSE_TIME => UpDownFieldType::ARRAY,
    ];
}