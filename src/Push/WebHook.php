<?php
/**
 * Copyright (c) 2019 - present
 * updown - WebHook.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Push;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\WebHookFields;
use Biscolab\UpDown\Objects\Check;
use Biscolab\UpDown\Types\DownTime;

/**
 * Class WebHook
 * @property string   event
 * @property Check    check
 * @property DownTime downtime
 * @package Biscolab\UpDown\Push
 */
class WebHook extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        WebHookFields::EVENT    => UpDownFieldType::STRING,
        WebHookFields::CHECK    => Check::class,
        WebHookFields::DOWNTIME => DownTime::class
    ];
}