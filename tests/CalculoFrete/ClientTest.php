<?php
namespace CorreiosTest\CalculoFrete;

use \Correios\CalculoFrete\Client;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $calculoFreteClient = new Client();

        $this->assertTrue($calculoFreteClient instanceof \Correios\CalculoFrete\Client);
    }
}
