<?php
namespace CorreiosTest\CEP;

use \Correios\CEP\Client;

class CEPClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $Client = new Client();

        $this->assertTrue($Client instanceof \Correios\CEP\Client);
    }
}
