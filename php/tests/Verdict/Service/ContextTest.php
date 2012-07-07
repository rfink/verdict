<?php

namespace Tests\Verdict\Service;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    Verdict\Context\Property\Type\StringType,
    Verdict\Context\Property\Type\DateType,
    Verdict\Context\Property\Type\BooleanType,
    Verdict\Context\Property\Type\ArrayType,
    Verdict\Service\Context\Discover,
    Verdict\Service\Context\Condensor,
    PHPUnit_Framework_TestCase;

class ContextTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test our discovery service - toJson
     * @return void
     */
    public function testDiscoverToJson()
    {
        $context = new GenericContext(array(
            'Namespaced' => array(
                'Number' => new GenericProperty(array(
                    'type' => new NumberType()
                )),
                'String' => new GenericProperty(array(
                    'type' => new StringType()
                )),
                'Date' => new GenericProperty(array(
                    'type' => new DateType()
                )),
                'Boolean' => new GenericProperty(array(
                    'type' => new BooleanType()
                )),
                'Array' => new GenericProperty(array(
                    'type' => new ArrayType()
                ))
            )
        ));
        $discoverService = new Discover();
        $contextJson = $discoverService->toJson($context);
        $this->assertEquals($contextJson['Namespaced']['Number']['type'], 'number');
        $this->assertEquals($contextJson['Namespaced']['String']['type'], 'string');
        $this->assertEquals($contextJson['Namespaced']['Date']['type'], 'date');
        $this->assertEquals($contextJson['Namespaced']['Boolean']['type'], 'boolean');
        $this->assertEquals($contextJson['Namespaced']['Array']['type'], 'array');
    }
    
    /**
     * Test our condensor service for appropriate behavior
     * @return void
     */
    public function testCondensorService()
    {
        $discoverService = new Discover();
        $context = new GenericContext(array(
            'TestParent' => array(
                'Child' => new GenericProperty(array(
                    'type' => new NumberType()
                ))
            ),
            'TestGrandParent' => array(
                'TestParent' => array(
                    'Child1' => new GenericProperty(array(
                        'type' => new NumberType()
                    )),
                    'Child2' => new GenericProperty(array(
                        'type' => new NumberType()
                    ))
                )
            ),
            'TestChild' => new GenericProperty(array(
                'type' => new NumberType()
            ))
        ));
        $condensorService = new Condensor();
        $flatContext = $condensorService->condenseVars($discoverService->toJson($context));
        $this->assertEquals(count($flatContext), 4);
        $this->assertArrayHasKey('TestParent::Child', $flatContext);
        $this->assertArrayHasKey('TestGrandParent::TestParent::Child1', $flatContext);
        $this->assertArrayHasKey('TestChild', $flatContext);
    }
}
