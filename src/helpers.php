<?php
/**
 * Copyright (c) 2018 - present
 * ipstack - helpers.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 17/11/2018
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown;

/**
 * @param string $camel
 *
 * @return string
 */
function camel2Snake(string $camel): string
{

    return preg_replace('/^_/', '', strtolower(implode('_', preg_split('/(?=[A-Z])/', $camel))));
}

/**
 * @param string $snake
 *
 * @return string
 */
function snake2Camel(string $snake): string
{

    return lcfirst(preg_replace('/_/', '', ucwords($snake, '_')));
}