<?php
/**
 * Copyright (c) 2019 - present
 * updown - UpDownRequestMethod.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 9/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Enum;

/**
 * Class UpDownRequestMethod
 * @package Biscolab\UpDown\Enum
 */
class UpDownRequestMethod
{

    /**
     * @var string - get
     */
    const GET = 'get';

    /**
     * @var string - post
     */
    const POST = 'post';

    /**
     * @var string - put
     */
    const PUT = 'put';

    /**
     * @var string - delete
     */
    const DELETE = 'delete';

}