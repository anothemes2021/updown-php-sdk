<?php
/**
 * Copyright (c) 2019 - present
 * updown - UpDownTest.php
 * author: Roberto Belotti - roby.belotti@gmail.com
 * web : robertobelotti.com, github.com/biscolab
 * Initial version created on: 15/2/2019
 * MIT license: https://github.com/biscolab/updown-php/blob/master/LICENSE
 */

namespace Tests\Unit;

use Biscolab\UpDown\Http\UpDownClient;
use Biscolab\UpDown\Tests\TestCase;
use Biscolab\UpDown\UpDown;

class UpDownTest extends TestCase
{

    /**
     * @test
     */
    public function testInstanceOfCheck()
    {

        $this->assertInstanceOf(UpDown::class, $this->updown);
    }

    /**
     * @test
     */
    public function testInstanceOfCheckFromInstanceMethod()
    {

        $this->assertInstanceOf(UpDown::class, UpDown::instance());
    }

    /**
     * @test
     */
    public function testBasicTest3()
    {

        $this->assertEquals($_ENV['API_KEY'], $this->updown->getKey());
    }

    /**
     * @test
     */
    public function testUpDownClient()
    {

        $this->assertInstanceOf(UpDownClient::class, $this->updown->getClient());
    }

}
