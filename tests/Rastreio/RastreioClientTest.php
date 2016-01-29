<?php

use Correios\Rastreio\RastreioClient;

class RastreioClientTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $rastreioClient = new RastreioClient();

        $this->assertTrue($rastreioClient instanceof Correios\Rastreio\RastreioClient);
    }
}
