<?php
/**
 * Copyright (c) 2019 - present
 * updown - Checks.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Types;

use Biscolab\UpDown\Abstracts\AbstractCollection;
use Biscolab\UpDown\Objects\Check;

/**
 * Class Checks
 * @package Biscolab\UpDown\Types
 */
class Checks extends AbstractCollection
{

    protected $children_class = Check::class;
}