<?php
namespace Correios\CEP;

use Correios\Interpreter\AbstractHTMLInterpreter;

class InterpreterMobileCorreiosCEP extends AbstractHTMLInterpreter
{
    CONST TAG = 'span';
    CONST PROPERTIES = [
        'class' => 'respostadestaque'
    ];

    public function __construct($tag = null, array $properties = [])
    {
        parent::__construct(
            $tag ?: self::TAG,
            $properties ?: self::PROPERTIES
        );
    }

    /**
     * Interprets the result from CEP mobile correios site.
     *
     * @param $html
     * @return array
     */
    public function interpret($html)
    {
        $extractedValues = $this->buildExtractedValues($this->extractValues($html));

        $result = [
            'logradouro' => $extractedValues[0],
            'bairro'     => $extractedValues[1],
            'localidade' => $extractedValues[4],
            'UF'         => $extractedValues[5],
        ];

        return $result;
    }

    /**
     * Build the CEP extracted values.
     *
     * @param $extractedValues
     * @return array
     */
    protected function buildExtractedValues($extractedValues)
    {
        if (!strpos($extractedValues[2], '/')) {
            throw new \InvalidArgumentException('An invalid Logradouro/UF was provided: ' . $extractedValues[2]);
        }

        $cidadeAndUF = $this->getCidadeAndUF($extractedValues[2]);
        $values = array_merge($extractedValues, $cidadeAndUF);
        $values = array_map('trim', $values);
        unset($values[2]);

        return $values;
    }

    /**
     * The result of Cidade and UF in correios site are brought together in a string, a '/' separates them.
     * So we break this string by a '/' and return both Cidade and UF in an array.
     *
     * @param $cidadeAndUF
     * @return array
     */
    protected function getCidadeAndUF($cidadeAndUF)
    {
        return explode('/', $cidadeAndUF);
    }
}