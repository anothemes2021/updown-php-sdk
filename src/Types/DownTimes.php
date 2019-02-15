<?php
/**
 * Copyright (c) 2019 - present
 * updown - DownTimes.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractCollection;

/**
 * Class DownTimes
 * @package Biscolab\UpDown\Types
 */
class DownTimes extends AbstractCollection
{

    protected $children_class = DownTime::class;
}