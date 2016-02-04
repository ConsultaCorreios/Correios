<?php
namespace Correios\CEP;

use Correios\Interpreter\AbstractHTMLInterpreter;

class Interpreter extends AbstractHTMLInterpreter
{
    public function interpret()
    {
        $values = $this->extractValues();
    }
}