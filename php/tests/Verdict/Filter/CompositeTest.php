<?php

namespace Tests\Verdict\Filter;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Filter\Composite\All,
    Verdict\Filter\Composite\Any,
    Verdict\Filter\Composite\None,
    Verdict\Filter\Comparison\Equals,
    Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    PHPUnit_Framework_TestCase,
    ArrayIterator;

class CompositeTest extends PHPUnit_Framework_TestCase
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
                'Property' => new GenericProperty(array(
                    'type' => new NumberType()
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
     * Test our all composite driver
     * @return void
     */
    public function testAll()
    {
        $this->context->setValue('Namespaced::Property', '1');
        $properties1 = new ArrayIterator(array(
            'configValue' => '1'
        ));
        $equals1 = new Equals($this->context, 'Namespaced::Property', $properties1);
        $properties2 = new ArrayIterator(array(
            'configValue' => '1'
        ));
        $equals2 = new Equals($this->context, 'Namespaced::Property', $properties2);
        $properties3 = new ArrayIterator(array(
            'configValue' => '1'
        ));
        $equals3 = new Equals($this->context, 'Namespaced::Property', $properties3);
        $allParams = new ArrayIterator(array(
            $equals1,
            $equals2,
            $equals3
        ));
        $all = new All($allParams);
        $this->assertEquals($all->evaluate(), true);
        $properties3['configValue'] = '2';
        $this->assertEquals($all->evaluate(), false);
    }
    
    /**
     * Test our any composite driver
     * @return void
     */
    public function testAny()
    {
        $this->context->setValue('Namespaced::Property', '1');
        $properties1 = new ArrayIterator(array(
            'configValue' => '1'
        ));
        $equals1 = new Equals($this->context, 'Namespaced::Property', $properties1);
        $properties2 = new ArrayIterator(array(
            'configValue' => '2'
        ));
        $equals2 = new Equals($this->context, 'Namespaced::Property', $properties2);
        $properties3 = new ArrayIterator(array(
            'configValue' => '3'
        ));
        $equals3 = new Equals($this->context, 'Namespaced::Property', $properties3);
        $allParams = new ArrayIterator(array(
            $equals1,
            $equals2,
            $equals3
        ));
        $all = new Any($allParams);
        $this->assertEquals($all->evaluate(), true);
        $properties1['configValue'] = '2';
        $this->assertEquals($all->evaluate(), false);
    }
    
    /**
     * Test our none composite driver
     * @return void
     */
    public function testNone()
    {
        $this->context->setValue('Namespaced::Property', '1');
        $properties1 = new ArrayIterator(array(
            'configValue' => '2'
        ));
        $equals1 = new Equals($this->context, 'Namespaced::Property', $properties1);
        $properties2 = new ArrayIterator(array(
            'configValue' => '2'
        ));
        $equals2 = new Equals($this->context, 'Namespaced::Property', $properties2);
        $properties3 = new ArrayIterator(array(
            'configValue' => '3'
        ));
        $equals3 = new Equals($this->context, 'Namespaced::Property', $properties3);
        $allParams = new ArrayIterator(array(
            $equals1,
            $equals2,
            $equals3
        ));
        $all = new None($allParams);
        $this->assertEquals($all->evaluate(), true);
        $properties1['configValue'] = '1';
        $this->assertEquals($all->evaluate(), false);
    }
}