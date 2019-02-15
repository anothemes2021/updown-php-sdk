<?php
/**
 * Copyright (c) 2019 - present
 * updown - Timings.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\TimingsFields;

/**
 * Class Metrics
 * @property int redirect
 * @property int namelookup
 * @property int connection
 * @property int handshake
 * @property int response
 * @package Biscolab\UpDown\Types
 */
class Timings extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        TimingsFields::REDIRECT   => UpDownFieldType::INT,
        TimingsFields::NAMELOOKUP => UpDownFieldType::INT,
        TimingsFields::CONNECTION => UpDownFieldType::INT,
        TimingsFields::HANDSHAKE  => UpDownFieldType::INT,
        TimingsFields::RESPONSE   => UpDownFieldType::INT,
        TimingsFields::TOTAL      => UpDownFieldType::INT,
    ];
}