<?php

use Correios\CalculoFrete\CalculoFreteClient;

class CalculoFreteClientTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $calculoFreteClient = new CalculoFreteClient();

        $this->assertTrue($calculoFreteClient instanceof Correios\CalculoFrete\CalculoFreteClient);
    }
}
