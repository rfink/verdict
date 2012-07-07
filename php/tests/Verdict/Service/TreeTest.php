<?php

namespace Tests\Verdict\Service;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Segment\Factory\Json as JsonFactory,
    Verdict\Service\Tree\Validator,
    PHPUnit_Framework_TestCase;

class TreeTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test validating a valid tree setup
     * @return void
     */
    public function testValidateValidTree()
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
                    'Condition' => array(
                        'nodeType' => 'comparison',
                        'nodeDriver' => 'equals',
                        'contextKey' => 'Stuff',
                        'configValue' => 0
                    )
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
        $validateService = new Validator($factory->build());
        $validateService->validate();
        // Done, no assertions necessary
    }
    
    /**
     * Test validating an invalid tree setup - no condition on a non-default node
     * @expectedException RuntimeException
     */
    public function testValidateInvalidTreeNoCondition()
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
        $validateService = new Validator($factory->build());
        $validateService->validate();
    }
    
    /**
     * Test validating an invalid tree setup - non truth condition on a default node
     * @expectedException RuntimeException
     */
    public function testValidateInvalidTreeInvalidConditionType()
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
                    'Condition' => array(
                        'nodeType' => 'thisisnotavalidnodetype',
                        'nodeDriver' => 'equals',
                        'contextKey' => 'Stuff',
                        'configValue' => 0
                    )
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
        $validateService = new Validator($factory->build());
        $validateService->validate();
    }
}
