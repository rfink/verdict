<?php

namespace Tests\Verdict\Filter;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Filter\Comparison\Equals,
    Verdict\Filter\Comparison\GreaterThan,
    Verdict\Filter\Comparison\GreaterThanEqualTo,
    Verdict\Filter\Comparison\LengthOf,
    Verdict\Filter\Comparison\LessThan,
    Verdict\Filter\Comparison\LessThanEqualTo,
    Verdict\Filter\Comparison\ListContains,
    Verdict\Filter\Comparison\ListNotContains,
    Verdict\Filter\Comparison\NotEquals,
    Verdict\Filter\Comparison\Range,
    Verdict\Filter\Comparison\RegEx,
    Verdict\Filter\Comparison\StringContains,
    Verdict\Filter\Comparison\StringNotContains,
    Verdict\Filter\Comparison\Truth,
    Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    PHPUnit_Framework_TestCase,
    ArrayIterator;

class ComparisonTest extends PHPUnit_Framework_TestCase
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
     * Test our equals driver
     * @return void
     */
    public function testEquals()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 1
        ));
        $equals = new Equals($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($equals->evaluate(), true);
        $properties['configValue'] = '1';
        $this->assertEquals($equals->evaluate(), true);
        $properties['configValue'] = '2';
        $this->assertEquals($equals->evaluate(), false);
    }
    
    /**
     * Test our greaterThan driver
     * @return void
     */
    public function testGreaterThan()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 0
        ));
        $greaterThan = new GreaterThan($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($greaterThan->evaluate(), true);
        $properties['configValue'] = 2;
        $this->assertEquals($greaterThan->evaluate(), false);
    }
    
    /**
     * Test our greaterThanEqualTo driver
     * @return void
     */
    public function testGreaterThanEqualTo()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 1
        ));
        $greaterThanEqualTo = new GreaterThanEqualTo($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($greaterThanEqualTo->evaluate(), true);
        $properties['configValue'] = 2;
        $this->assertEquals($greaterThanEqualTo->evaluate(), false);
        $properties['configValue'] = 0;
        $this->assertEquals($greaterThanEqualTo->evaluate(), true);
    }
    
    /**
     * Test our lengthOf driver
     * @return void
     */
    public function testLengthOf()
    {
        $this->context->setValue('Namespaced::Property', 'myString');
        $properties = new ArrayIterator(array(
            'configValue' => 8
        ));
        $lengthOf = new LengthOf($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($lengthOf->evaluate(), true);
        $properties['configValue'] = 9;
        $this->assertEquals($lengthOf->evaluate(), false);
        $this->context->setValue('Namespaced::Property', array('1', '2', '3'));
        $properties['configValue'] = 3;
        $this->assertEquals($lengthOf->evaluate(), true);
    }
    
    /**
     * Test our lessThan driver
     * @return void
     */
    public function testLessThan()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 2
        ));
        $lessThan = new LessThan($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($lessThan->evaluate(), true);
        $properties['configValue'] = 0;
        $this->assertEquals($lessThan->evaluate(), false);
    }
    
    /**
     * Test our lessThanEqualTo driver
     * @return void
     */
    public function testLessThanEqualTo()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 1
        ));
        $lessThanEqualTo = new LessThanEqualTo($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($lessThanEqualTo->evaluate(), true);
        $properties['configValue'] = 2;
        $this->assertEquals($lessThanEqualTo->evaluate(), true);
        $properties['configValue'] = 0;
        $this->assertEquals($lessThanEqualTo->evaluate(), false);
    }
    
    /**
     * Test our listContains driver
     * @return void
     */
    public function testListContains()
    {
        $this->context->setValue('Namespaced::Property', array(1, 2, 3));
        $properties = new ArrayIterator(array(
            'configValue' => 1
        ));
        $listContains = new ListContains($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($listContains->evaluate(), true);
        $properties['configValue'] = 4;
        $this->assertEquals($listContains->evaluate(), false);
    }
    
    /**
     * Test our listNotContains driver
     * @return void
     */
    public function testListNotContains()
    {
        $this->context->setValue('Namespaced::Property', array(1, 2, 3));
        $properties = new ArrayIterator(array(
            'configValue' => 4
        ));
        $listNotContains = new ListNotContains($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($listNotContains->evaluate(), true);
        $properties['configValue'] = 1;
        $this->assertEquals($listNotContains->evaluate(), false);
    }
    
    /**
     * Test our notEquals driver
     * @return void
     */
    public function testNotEquals()
    {
        $this->context->setValue('Namespaced::Property', 1);
        $properties = new ArrayIterator(array(
            'configValue' => 2
        ));
        $notEquals = new NotEquals($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($notEquals->evaluate(), true);
        $properties['configValue'] = '1';
        $this->assertEquals($notEquals->evaluate(), false);
        $properties['configValue'] = '2';
        $this->assertEquals($notEquals->evaluate(), true);
    }
    
    /**
     * Test our range driver
     * @return void
     */
    public function testRange()
    {
        $this->context->setValue('Namespaced::Property', 2);
        $properties = new ArrayIterator(array(
            'min' => 1,
            'max' => 3
        ));
        $range = new Range($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($range->evaluate(), true);
        $this->context->setValue('Namespaced::Property', 1);
        $this->assertEquals($range->evaluate(), true);
        $this->context->setValue('Namespaced::Property', 3);
        $this->assertEquals($range->evaluate(), true);
        $this->context->setValue('Namespaced::Property', 4);
        $this->assertEquals($range->evaluate(), false);
    }
    
    /**
     * Test our regEx driver
     * @return void
     */
    public function testRegEx()
    {
        $this->context->setValue('Namespaced::Property', 'thisisastring');
        $properties = new ArrayIterator(array(
            'configValue' => 'is[a-z]s'
        ));
        $regEx = new RegEx($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($regEx->evaluate(), true);
        $properties['configValue'] = '\s';
        $this->assertEquals($regEx->evaluate(), false);
    }
    
    /**
     * Test our stringContains driver
     * @return void
     */
    public function testStringContains()
    {
        $this->context->setValue('Namespaced::Property', 'somestring');
        $properties = new ArrayIterator(array(
            'configValue' => 'om'
        ));
        $stringContains = new StringContains($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($stringContains->evaluate(), true);
        $properties['configValue'] = 'g';
        $this->assertEquals($stringContains->evaluate(), true);
        $properties['configValue'] = 'nada';
        $this->assertEquals($stringContains->evaluate(), false);
    }
    
    /**
     * Test our stringNotContains driver
     * @return void
     */
    public function testStringNotContains()
    {
        $this->context->setValue('Namespaced::Property', 'somestring');
        $properties = new ArrayIterator(array(
            'configValue' => 'nada'
        ));
        $stringNotContains = new StringNotContains($this->context, 'Namespaced::Property', $properties);
        $this->assertEquals($stringNotContains->evaluate(), true);
        $properties['configValue'] = 'g';
        $this->assertEquals($stringNotContains->evaluate(), false);
        $properties['configValue'] = 'om';
        $this->assertEquals($stringNotContains->evaluate(), false);
    }
    
    /**
     * Test our truth driver
     * @return void
     */
    public function testTruth()
    {
        $truth = new Truth();
        $this->assertEquals($truth->evaluate(), true);
    }

}
