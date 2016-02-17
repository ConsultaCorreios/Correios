<?php
namespace CorreiosTest\CEP;

use \Correios\CEP\Client as CEPClient;

class CEPClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectiIstance()
    {
        $cepClient = new CEPClient('');

        $this->assertTrue($cepClient instanceof \Correios\CEP\Client);
    }
}
