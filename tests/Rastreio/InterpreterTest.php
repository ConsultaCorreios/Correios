<?php
namespace CorreiosTest\Rastreio;

use \Correios\Rastreio\Interpreter;

class InterpreterTest extends \PHPUnit_Framework_TestCase
{
    public function testCorrectInstanceOf()
    {
        $html = "<html></html>";

        $Client = new Interpreter($html);

        $this->assertTrue($Client instanceof \Correios\Rastreio\Interpreter);
    }
}