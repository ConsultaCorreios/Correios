<?php
namespace Correios\Interpreter;

/**
 * Interpreter class to extract the value from a given HTML tag.
 * If there is multiple occurrences of the tag in the parsed HTML, it'll return an array with the extracted values.
 *
 * Class AbstractHTMLInterpreter
 * @package Correios\Interpreter
 */
abstract class AbstractHTMLInterpreter
{
    CONST DRAFT_REG_EXP_HTML = '#<\s*?%s %s>(.*?)</%s\b[^>]*>#s';

    private $html;
    private $tag;
    private $properties;

    public function __construct($html, $tag, array $properties = [])
    {
        $this->html = $html;
        $this->tag = $tag;
        $this->properties = $properties;
    }

    /**
     * Interpret the HTML.
     *
     * @return mixed
     */
    abstract public function interpret();

    /**
     * Extract the values inside the tag.
     *
     * @return array
     */
    protected function extractValues()
    {
        $tagProperties = '';
        if (count($this->properties) != 0) {
            $tagProperties = $this->buildTagProperties($this->properties);
        }

        $regExp = $this->buildRegExp($tagProperties);

        return $this->getValuesInTags($regExp);
    }

    /**
     * It'll insert the tag, and tag properties inside the regular expression to be
     * further used to get the value inside the html tag.
     *
     * @param $tagProperties
     * @return string
     */
    private function buildRegExp($tagProperties)
    {
        return sprintf(self::DRAFT_REG_EXP_HTML, $this->tag, $tagProperties, $this->tag);
    }

    /**
     * It'll use the regular expression to extract the values.
     *
     * @param $regExp
     * @return mixed
     */
    private function getValuesInTags($regExp)
    {
        preg_match_all($regExp, $this->html, $matches);

        return $matches[1];
    }

    /**
     * It'll build the properties of the tag to build the regular expression.
     *
     * @param $properties
     * @return string
     */
    private function buildTagProperties($properties)
    {
        $tagProperties = '';
        foreach ($properties as $property => $value) {

            $tagProperties .= $property . '="' . $value . '"';

            if ($value !== end($properties)) {
                $tagProperties .=  ' ';
            }

        }

        return $tagProperties;
    }
}
