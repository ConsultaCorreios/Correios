<?php

namespace Correios\CEP;

class Client
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function getCEP($requestCEP)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestCEP);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        $result = mb_convert_encoding($result,'utf-8', 'ISO-8859-1');
        curl_close ($ch);

        return $result;
    }
}
