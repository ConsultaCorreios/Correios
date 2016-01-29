<?php

use Correios\Rastreio\RastreioService;

class RastreioServiceTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $rastreioService = new RastreioService();

        $this->assertTrue($rastreioService instanceof Correios\Rastreio\RastreioService);
    }
}
