<?php
namespace CorreiosTest\Rastreio;

use Correios\Rastreio\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $rastreioClient = new Client();

        $this->assertTrue($rastreioClient instanceof \Correios\Rastreio\Client);
    }
}
