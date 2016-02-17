<?php
namespace CorreiosTest\CEP;

use Correios\CEP\Service as CEPService;
use Correios\CEP\Client;
use Correios\CEP\InterpreterMobileCorreiosCEP;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider CEPStandardServiceMockReturns
     */
    public function testCompleteCallToCEPStandardService($interpreterMockWillReturn, $clientMockWillReturn)
    {
        $interpreterMobileCorreiosCEPMock = $this
            ->getMockBuilder('Correios\CEP\InterpreterMobileCorreiosCEP')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $interpreterMobileCorreiosCEPMock
            ->expects($this->once())
            ->method('interpret')
            ->willReturn($interpreterMockWillReturn)
        ;

        $clientMock = $this
            ->getMockBuilder('Correios\CEP\Client')
            ->disableOriginalConstructor()
            ->getMock()
        ;
        $clientMock
            ->expects($this->once())
            ->method('getCEP')
            ->willReturn($clientMockWillReturn)
        ;

        $requestCEPMock = $this
            ->getMockBuilder('Correios\CEP\RequestCEP')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $requestCEPMock
            ->expects($this->once())
            ->method('build')
        ;

        $cepService = CEPService::createUsingStandardService('69900007', $clientMock, $interpreterMobileCorreiosCEPMock, $requestCEPMock);

        $this->assertEquals($cepService->getCEP(), $interpreterMockWillReturn);
    }

    /**
     * @dataProvider CEPStandardServiceMockReturns
     */
    public function testRealCallIntegration($expectedServiceOutput)
    {
        $cepService = CEPService::createUsingStandardService('69900007');

        $this->assertEquals($cepService->getCEP(), $expectedServiceOutput);
    }

    public function CEPStandardServiceMockReturns()
    {
        return [
            [
                [
                    'logradouro' => 'Travessa Feijó',
                    'bairro'     => 'Base',
                    'localidade' => 'Rio Branco',
                    'UF'         => 'AC'
                ],
                file_get_contents(__DIR__ . '/../resources/consultaCEPResultado.txt')
            ]
        ];
    }
}