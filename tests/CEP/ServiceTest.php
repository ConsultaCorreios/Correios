<?php
namespace CorreiosTest\CEP;

use Correios\CEP\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $Service = new Service();

        $this->assertTrue($Service instanceof \Correios\CEP\Service);
    }
}