<?php
/**
 * Copyright (c) 2019 - present
 * updown - Ssl.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\SslFields;

/**
 * Class Ssl
 * @package Biscolab\UpDown\Types
 */
class Ssl extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        SslFields::TESTED_AT => UpDownFieldType::DATETIME,
        SslFields::VALID     => UpDownFieldType::BOOL,
        SslFields::ERROR     => UpDownFieldType::STRING
    ];
}