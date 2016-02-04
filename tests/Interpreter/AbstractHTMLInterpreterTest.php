<?php
namespace CorreiosTest\Interpreter;

use Correios\Interpreter\AbstractHTMLInterpreter;

class AbstractInterpreterTest extends \PHPUnit_Framework_TestCase
{
    CONST REG_EXP_HTML = '#<\s*?%s %s>(.*?)</%s\b[^>]*>#s';
    private $html;
    private $tag;
    private $properties;

    public function setUp()
    {
        $this->html = '<span class="respostadestaque">Teste Monstro</span>';

        $this->tag = 'span';

        $this->properties = [
            'class' => 'respostadestaque'
        ];
    }

    public function testTheTagPropertiesIsCorrectBuilded()
    {
        $interpreterMock = $this->getInterpreterMock();

        $methodExtractValuesAccessible = $this->getAccessibleMethodByReflection($interpreterMock, 'buildTagProperties');

        $tagProperties = $methodExtractValuesAccessible->invokeArgs($interpreterMock, [$this->properties]);

        $this->assertEquals($tagProperties, 'class="respostadestaque"');
    }

    public function testTheRegExpIsCorrectedBuilt()
    {
        $interpreterMock = $this->getInterpreterMock();

        $generatedProperties = $this->generateTagProperties($this->properties);
        $builtRegExp = $this->buildRegExp("span", $generatedProperties);

        $methodExtractValuesAccessible = $this->getAccessibleMethodByReflection($interpreterMock, 'buildRegExp');

        $regExp = $methodExtractValuesAccessible->invokeArgs($interpreterMock, [$generatedProperties]);

        $this->assertEquals($regExp, $builtRegExp);
    }

    public function testTheValueExtractedIsCorrect()
    {
        $interpreterMock = $this->getInterpreterMock();

        $generatedProperties = $this->generateTagProperties($this->properties);
        $builtRegExp = $this->buildRegExp("span", $generatedProperties);

        $methodExtractValuesAccessible = $this->getAccessibleMethodByReflection($interpreterMock, 'getValuesInTags');

        $extractedValues = $methodExtractValuesAccessible->invokeArgs($interpreterMock, [$builtRegExp]);

        $this->assertEquals($extractedValues[0], 'Teste Monstro');
    }

    private function getInterpreterMock()
    {
        return $this->getMockForAbstractClass(
                'Correios\Interpreter\AbstractHTMLInterpreter',
                [
                    $this->html,
                    $this->tag,
                    $this->properties
                ]
            )
        ;
    }
    
    private function generateTagProperties(array $properties)
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

    private function buildRegExp($tag, $tagProperties)
    {
        return sprintf(self::REG_EXP_HTML, $tag, $tagProperties, $tag);
    }

    private function getAccessibleMethodByReflection($class, $method)
    {
        $reflectionClass = new \ReflectionClass(get_class($class));
        $method = $reflectionClass->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }
}