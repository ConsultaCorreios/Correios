<?php

use Correios\CEP\CEPClient;

class CEPClientTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $cepClient = new CEPClient();

        $this->assertTrue($cepClient instanceof Correios\CEP\CEPClient);
    }
}
