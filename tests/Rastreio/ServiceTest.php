<?php
namespace CorreiosTest\Rastreio;

use Correios\Rastreio\Service;

class RastreioServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $Service = new Service();

        $this->assertTrue($Service instanceof \Correios\Rastreio\Service);
    }
}
