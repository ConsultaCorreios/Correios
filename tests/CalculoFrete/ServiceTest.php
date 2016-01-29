<?php
namespace CorreiosTest\CalculoFrete;

use \Correios\CalculoFrete\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $calculoFreteService = new Service();

        $this->assertTrue($calculoFreteService instanceof \Correios\CalculoFrete\Service);
    }
}
