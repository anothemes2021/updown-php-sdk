<?php
/**
 * Copyright (c) 2019 - present
 * updown - Eventhp
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Objects;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\EventFields;
use Biscolab\UpDown\Objects\Check;
use Biscolab\UpDown\Types\DownTime;

/**
 * Class Event
 * @property string   event
 * @property Check    check
 * @property DownTime downtime
 * @package Biscolab\UpDown\Objects
 */
class Event extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        EventFields::EVENT    => UpDownFieldType::STRING,
        EventFields::CHECK    => Check::class,
        EventFields::DOWNTIME => DownTime::class
    ];
}