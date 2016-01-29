<?php

use Correios\CEP\CEPService;

class CEPServiceTest extends PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $cepService = new CEPService();

        $this->assertTrue($cepService instanceof Correios\CEP\CEPService);
    }
}