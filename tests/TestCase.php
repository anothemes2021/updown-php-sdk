<?php
/**
 * Copyright (c) 2019 - present
 * updown - TestCase.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Biscolab\UpDown\Tests;

use Biscolab\UpDown\Fields\UpDownRequestFields;
use Biscolab\UpDown\Objects\Check;
use Biscolab\UpDown\UpDown;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * Class TestCase
 * @package Biscolab\ReCaptcha\Tests
 */
class TestCase extends BaseTestCase
{

    /**
     * @var UpDown
     */
    protected $updown = null;

    /**
     * @var Check
     */
    protected $check;

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {

        parent::setUp(); // TODO: Change the autogenerated stub

        $this->updown = UpDown::init([
            UpDownRequestFields::API_KEY => $_ENV['API_KEY']
        ]);

        $this->check = new Check();
    }
}
