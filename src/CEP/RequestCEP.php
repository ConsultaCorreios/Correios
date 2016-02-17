<?php
namespace Correios\CEP;

class RequestCEP
{
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function build()
    {
        return http_build_query($this->parameters);
    }
}