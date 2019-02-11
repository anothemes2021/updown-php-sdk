<?php
/**
 * Copyright (c) 2018 - present
 * ipstack - UpDownRequest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 17/11/2018
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Http;

use Biscolab\UpDown\Abstracts\AbstractObject;

/**
 * Class UpDownRequest
 * @package Biscolab\UpDown\Http
 */
class UpDownRequest
{

    /**
     * @var array
     */
    private $params = [];

    /**
     * UpDownRequest constructor.
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {

        if ($params) {
            foreach ($params as $param_name => $param_value) {
                $this->addParam($param_name, $param_value);
            }
        }
    }

    /**
     * @param string         $param_name
     * @param AbstractObject $param_value
     *
     * @return UpDownRequest
     */
    public function addParam(string $param_name, $param_value): UpDownRequest
    {

        $this->params[$param_name] = $param_value;

        return $this;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {

        $params = [];

        foreach ($this->params as $param_name => $param_value) {
            $params[$param_name] = (string)$param_value;
        }

        return http_build_query($params);
    }

}