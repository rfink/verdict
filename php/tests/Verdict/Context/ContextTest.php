<?php

namespace Tests\Verdict\Context;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    PHPUnit_Framework_TestCase;

class ContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Our local context object
     * @var GenericContext
     */
    protected $context;
    
    /**
     * Set up run prior to each test
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();
        $this->context = new GenericContext(array(
            'Keyspace' => array(
                'Prop1' => new GenericProperty(array(
                    'type' => new NumberType()
                ))
            )
        ));
    }

    /**
     * Test that supplying an empty key throws the correct exception
     * @expectedException InvalidArgumentException
     */
    public function testEmptyKeyThrowsException()
    {
        $this->context->getValue('');
    }
    
    /**
     * Test that supplying an invalid key throws the correct exception
     * @expectedException InvalidArgumentException
     */
    public function testInvalidKeyThrowsException()
    {
        $this->context->getValue('WrongKeySpace::Prop2');
    }
}
