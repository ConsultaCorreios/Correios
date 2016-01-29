<?php

use Correios\CalculoFrete\CalculoFreteService;

class CalculoFreteServiceTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $calculoFreteService = new CalculoFreteService();

        $this->assertTrue($calculoFreteService instanceof Correios\CalculoFrete\CalculoFreteService);
    }
}
