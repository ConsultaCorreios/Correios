<?php
namespace CorreiosTest\CEP;

use Correios\CEP\InterpreterMobileCorreiosCEP;

class InterpreterMobileCorreiosCEPTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider interpretedCEPResultProvider
     */
    public function testTheGivenHTMLWithAExampleReturnFromCEPCorreiosServiceWillBeCorrectlyParsed($interpretedCEPResultProvider) {

        $cepHTMLResultFixture = file_get_contents(__DIR__ . '/../resources/consultaCEPResultado.txt');

        $interpreterCEP = new InterpreterMobileCorreiosCEP();

        $result = $interpreterCEP->interpret($cepHTMLResultFixture);

        $this->assertTrue($result == $interpretedCEPResultProvider);

    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /An invalid Logradouro\/UF was provided:/
     */
    public function testAInvalidArgumentExceptionWillBeThrownIfAnInvalidLogradouroUFHasBeenProvided() {

        $tag = 'span';
        $properties = [
            'class' => 'respostadestaque'
        ];

        $cepHTMLResultFixture = <<<RESULTWITHINCORRECTLOCALIDADE
        <span class="resposta">Logradouro: </span>
                                <span class="respostadestaque">
        Travessa Feijó

        </span><br/>
                                <span class="resposta">Bairro: </span><span class="respostadestaque">Base</span><br/>
                                <span class="resposta">Localidade / UF: </span>
                                <span class="respostadestaque">
        Rio Branco

        AC

        </span><br/>
                                <span class="resposta">CEP: </span><span class="respostadestaque">69900007</span><br/>
RESULTWITHINCORRECTLOCALIDADE;

        $interpreterCEP = new InterpreterMobileCorreiosCEP($tag, $properties);

        $result = $interpreterCEP->interpret($cepHTMLResultFixture);

    }

    public function interpretedCEPResultProvider()
    {
        return [
            [
                [
                    'logradouro' => 'Travessa Feijó',
                    'bairro'     => 'Base',
                    'localidade' => 'Rio Branco',
                    'UF'         => 'AC'
                ]
            ]
        ];
    }
}
