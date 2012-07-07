<?php

namespace Tests\Verdict\Service;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Segment\Factory\Json as JsonFactory,
    PHPUnit_Framework_TestCase;

class FactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test that running a factory build on a valid configuration returns a tree
     * @return void
     */
    public function testValidFactory()
    {
        $context = new GenericContext();
        $treeJson = array(
            'segmentName' => 'Root',
            'segmentId' => 1,
            'children' => array(
                array(
                    'segmentName' => 'Child #1',
                    'segmentId' => 2,
                    'children' => array(),
                    'Condition' => array()
                ),
                array(
                    'segmentName' => 'Default',
                    'segmentId' => 3,
                    'children' => array(),
                    'Condition' => null
                )
            )
        );
        $factory = new JsonFactory($treeJson, $context);
        $tree = $factory->build();
        $this->assertInstanceOf('Verdict\Segment\Tree', $tree);
    }    
}
