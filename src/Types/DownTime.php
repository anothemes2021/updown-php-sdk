<?php
/**
 * Copyright (c) 2019 - present
 * updown - DownTime.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\DownTimeFields;

/**
 * Class DownTime
 * @property string error
 * @property int    started_at
 * @property int    ended_at
 * @property int    duration
 * @package Biscolab\UpDown\Types
 */
class DownTime extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        DownTimeFields::ERROR      => UpDownFieldType::STRING,
        DownTimeFields::STARTED_AT => UpDownFieldType::DATETIME,
        DownTimeFields::ENDED_AT   => UpDownFieldType::DATETIME,
        DownTimeFields::DURATION   => UpDownFieldType::INT
    ];
}