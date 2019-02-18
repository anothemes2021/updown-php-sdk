<?php
/**
 * Copyright (c) 2019 - present
 * updown - UpDownResult.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Http;

/**
 * Class UpDownResult
 * @package Biscolab\UpDown\Http
 */
class UpDownResult
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * UpDownResult constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {

        $this->data = $data;
    }

    /**
     * @return array
     */
    public function getData(): array
    {

        return $this->data;
    }
}