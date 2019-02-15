<?php
/**
 * Copyright (c) 2019 - present
 * updown - Metrics.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractObject;
use Biscolab\UpDown\Enum\UpDownFieldType;
use Biscolab\UpDown\Fields\MetricsFields;

/**
 * Class Metrics
 * @property int    apdex
 * @property string requests
 * @property bool   timings
 * @package Biscolab\UpDown\Types
 */
class Metrics extends AbstractObject
{

    /**
     * @var array
     */
    protected $typeCheck = [
        MetricsFields::APDEX    => UpDownFieldType::INT,
        MetricsFields::REQUESTS => UpDownFieldType::BOOL,
        MetricsFields::TIMINGS  => UpDownFieldType::STRING
    ];
}