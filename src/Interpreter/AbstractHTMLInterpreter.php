<?php
namespace Correios\Interpreter;

/**
 * Interpreter class to extract the value from a given HTML tag.
 *
 * The Interpreter will basically receive an html to be parsed. The parse will extract an value inside a
 * specific tag, using regular expressions.
 *
 * If there is multiple occurrences of the tag in the parsed HTML, it'll return an array with the extracted values.
 *
 * Class AbstractHTMLInterpreter
 * @package Correios\Interpreter
 */
abstract class AbstractHTMLInterpreter implements Interpreter
{
    /**
     * The draft of the Regular Expression to be used to extract the value of the chosen HTML tag.
     * The '%s' are going to be replaced by the tag name, properties of the tag, and tag name, respectively.
     */
    CONST DRAFT_REG_EXP_HTML = '#<\s*?%s %s>(.*?)</%s\b[^>]*>#s';

    /**
     * The html tag to be extracted the values.
     *
     * @var String
     */
    protected $tag;

    /**
     * The properties of the html tag.
     *
     * @var array
     */
    protected $properties;

    /**
     * @param String $tag
     * @param array $properties
     */
    public function __construct($tag, array $properties = [])
    {
        $this->tag = $tag;
        $this->properties = $properties;
    }

    /**
     * Interpret the html.
     *
     * @param $html
     * @return mixed
     */
    abstract public function interpret($html);

    /**
     * Extract the values inside the tag.
     *
     * @return array
     */
    protected function extractValues($html)
    {
        $tagProperties = $this->buildTagProperties($this->properties);

        $regExp = $this->buildRegExp($tagProperties);

        return $this->getValuesInTags($html, $regExp);
    }

    /**
     * It'll insert the tag, and tag properties inside the regular expression to be
     * further used to get the value inside the html tag.
     *
     * @param $tagProperties
     * @return string
     */
    protected function buildRegExp($tagProperties)
    {
        return sprintf(self::DRAFT_REG_EXP_HTML, $this->tag, $tagProperties, $this->tag);
    }

    /**
     * It'll use the regular expression to extract the values.
     *
     * @param $html
     * @param $regExp
     * @return mixed
     */
    protected function getValuesInTags($html, $regExp)
    {
        preg_match_all($regExp, $html, $matches);

        return $matches[1];
    }

    /**
     * It'll build the properties of the tag to build the regular expression.
     *
     * @param $properties
     * @return string
     */
    protected function buildTagProperties(array $properties = [])
    {
        if (count($properties) == 0) {
            return '';
        }

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
