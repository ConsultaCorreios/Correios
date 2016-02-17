<?php

namespace Correios\CEP;

use Correios\Interpreter\Interpreter;

/**
 * Service to get the information of a given Zip Code.
 *
 * Class Service
 * @package Correios\CEP
 */
class Service
{
    /**
     * Interpreter to interpret the result that the Correios service returned after the request.
     *
     * @var Interpreter
     */
    private $interpreter;

    /**
     * Client to make the request to the Correios service.
     *
     * @var Client
     */
    private $client;

    /**
     * Factory to build the request to be properly sent to the Correios service.
     *
     * @var RequestCEP
     */
    private $requestCEP;

    private function __construct(Interpreter $interpreterCEP, Client $client, RequestCEP $requestCEP) {
        $this->interpreter = $interpreterCEP;
        $this->requestCEP = $requestCEP;
        $this->client = $client;
    }

    /**
     * Get CEP information based in the provided CEP.
     *
     * @return mixed
     */
    public function getCEP()
    {
        $request = $this->requestCEP->build();

        $result = $this->client->getCEP($request);

        $interpretedResult = $this->interpreter->interpret($result);

        return $interpretedResult;
    }

    /**
     * Create the basic dependencies to make the service to get the CEP information
     * using the standard service(mobile website from Correios).
     *
     * @param $CEP
     * @param \Correios\CEP\Client|null $client
     * @param InterpreterMobileCorreiosCEP|null $interpreterCEP
     * @param RequestCEP|null $requestCEP
     * @return Service
     */
    public static function createUsingStandardService(
        $CEP,
        Client $client = null,
        InterpreterMobileCorreiosCEP $interpreterCEP = null,
        RequestCEP $requestCEP = null
    ) {

        $config = self::getCEPConfig();
        $config['fromMobileCorreiosSite']['parameters']['cepEntrada'] = $CEP;

        $interpreterCEP = $interpreterCEP ?: new InterpreterMobileCorreiosCEP();
        $client = $client ?: new Client($config['fromMobileCorreiosSite']['url']);
        $requestCEP = $requestCEP ?: new RequestCEP($config['fromMobileCorreiosSite']['parameters']);

        return new self($interpreterCEP, $client, $requestCEP);

    }

    /**
     * Get the configuration to make the request.
     *
     * @return mixed
     */
    public static function getCEPConfig()
    {
        $correiosConfigJSON = file_get_contents(__DIR__ . '/../../resources/configuration.json');

        $correiosConfig = json_decode($correiosConfigJSON, true);

        return $correiosConfig['services']['CEP'];
    }
}

