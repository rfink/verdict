<?php

namespace Tests\Verdict\Filter;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    Verdict\Context\Property\Type\StringType,
    Verdict\Context\Property\Type\DateType,
    Verdict\Context\Property\Type\BooleanType,
    Verdict\Context\Property\Type\ArrayType,
    Verdict\Filter\Factory\Json as JsonFactory,
    PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Generic context object
     * @var GenericContext
     */
    private $context;
    
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();
        $this->context = new GenericContext(array(
            'Namespaced' => array(
                'Number' => new GenericProperty(array(
                    'type' => new NumberType()
                )),
                'String' => new GenericProperty(array(
                    'type' => new StringType()
                )),
                'DateType' => new GenericProperty(array(
                    'type' => new DateType()
                )),
                'BooleanType' => new GenericProperty(array(
                    'type' => new BooleanType()
                )),
                'ArrayType' => new GenericProperty(array(
                    'type' => new ArrayType()
                ))
            )
        ));
    }
    
    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->context = null;
        parent::tearDown();
    }
    
    /**
     * Test our json factory for verdict filter objects (using json string)
     * @return void
     */
    public function testJsonFactoryString()
    {
        $jsonString = '';
        $factory = new JsonFactory($this->context, $jsonString);
        $filter = $factory->build();
        $this->assertInstanceOf('Verdict\Filter\FilterInterface', $filter);
    }
    
    /**
     * Test our json factory for verdict filter objects (using json array)
     * @return void
     */
    public function testJsonFactoryArray()
    {
        $jsonArray = array();
        $factory = new JsonFactory($this->context, $jsonArray);
        $filter = $factory->build();
        $this->assertInstanceOf('Verdict\Filter\FilterInterface', $filter);
    }
    
    /**
     * Test trying the factory with an invalid data type (non-string, non-array)
     * @return void
     * @expectedException InvalidArgumentException
     */
    public function testJsonFactoryInvalid()
    {
        $factory = new JsonFactory($this->context, true);
    }
    
    /**
     * Test that no node type throws an exception
     * TODO: ExpectedException
     * @return void
     */
    public function testJsonFactoryNoNodeType()
    {
        //$factory = new JsonFactory($this->context);
    }
    
    /**
     * Test building an invalid filter (composite with no children)
     * @expectedException InvalidArgumentException
     */
    public function testJsonFactoryWithNoCompositeChildren()
    {
        $filterJson = array(
            'nodeType' => 'composite',
            'nodeDriver' => 'all'
        );
        $factory = new JsonFactory($this->context, $filterJson);
        $tree = $factory->build();
    }
    
    /**
     * Test that passing no object to the factory returns a truth type
     * @return void
     */
    public function testEmptyJsonBuildsTruth()
    {
        $factory = new JsonFactory($this->context);
        $filter = $factory->build();
        $this->assertInstanceOf('Verdict\Filter\Comparison\Truth', $filter);
    }
}
