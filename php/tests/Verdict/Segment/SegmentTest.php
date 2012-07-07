<?php

namespace Tests\Verdict\Segment;

require_once(__DIR__ . '/../../autoloader.php');

use Verdict\Context\Generic as GenericContext,
    Verdict\Context\Property\Generic as GenericProperty,
    Verdict\Context\Property\Type\NumberType,
    Verdict\Context\Property\Type\StringType,
    Verdict\Context\Property\Type\DateType,
    Verdict\Context\Property\Type\BooleanType,
    Verdict\Context\Property\Type\ArrayType,
    Verdict\Segment\Tree,
    Verdict\Segment\Factory\Json as SegmentFactory,
    Verdict\Filter\Comparison\Equals,
    Verdict\Filter\Comparison\Truth,
    PHPUnit_Framework_TestCase,
    ArrayIterator;

class SegmentTest extends PHPUnit_Framework_TestCase
{
    /**
     * Our generic context object
     * @var GenericContext
     */
    private $context;
    
    /**
     * Tree object
     * @var Tree
     */
    private $tree;
    
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
        $this->context->setValue('Namespaced::Number', 2);
        $this->tree = new Tree(new Truth($this->context));
        $this->tree->setSegmentId(1);
        $this->tree->setSegmentName('Segment #1');
        $childArray = array();
        for ($i = 1; $i <= 3; ++$i)
        {
            if ($i !== 3)
            {
                $properties = new ArrayIterator(array(
                    'configValue' => $i
                ));
                $condition = new Equals($this->context, 'Namespaced::Number', $properties);
                $segment = new Tree($condition);
                $segment->setSegmentId($i + 1);
                $segment->setSegmentName('Segment #' . ($i + 1));
            }
            else
            {
                $segment = new Tree(new Truth($this->context));
                $segment->setSegmentId(4);
                $segment->setSegmentName('Default');
            }
            $childArray[] = $segment;
        }
        $this->tree->setChildren($childArray);
    }
    /**
     * @inheritDoc
     */
    protected function tearDown()
    {
        $this->context = $this->tree = null;
        parent::tearDown();
    }
    
    /**
     * Test getting our leaf node based on condition
     * @return void
     */
    public function testGetLeafNode()
    {
        $leaf = $this->tree->getLeafNode();
        $this->assertEquals($leaf['node']->getSegmentId(), 3);
    }
    
    /**
     * Test fetching all leaves in the tree
     * @return void
     */
    public function testGetAllLeaves()
    {
        $leaves = $this->tree->getAllLeaves();
        $this->assertEquals(count($leaves), 3);
        /* @var $leaf Tree */
        foreach ($leaves as $leaf)
        {
            $this->assertInstanceOf('Verdict\Segment\Tree', $leaf);
        }
    }
    
    /**
     * Test running all leaf nodes, making sure we only match valid conditions
     * @return void
     */
    public function testRunAllLeafNodes()
    {
        $factory = new SegmentFactory(array(
            'segmentId' => '1',
            'segmentName' => 'Root',
            'Condition' => null,
            'children' => array(
                array(
                    'segmentId' => '2',
                    'segmentName' => 'Def 1',
                    'Condition' => array(
                        'nodeType' => 'comparison',
                        'nodeDriver' => 'equals',
                        'contextKey' => 'Namespaced::Number',
                        'configValue' => 2
                    ),
                    'children' => array(
                        array(
                            'segmentId' => '3',
                            'segmentName' => 'Def 2',
                            'Condition' => array(
                                'nodeType' => 'comparison',
                                'nodeDriver' => 'equals',
                                'contextKey' => 'Namespaced::Number',
                                'configValue' => 3
                            ),
                            'children' => array()
                        )
                    )
                ),
                array(
                    'segmentId' => '4',
                    'segmentName' => 'Def 3',
                    'Condition' => array(
                        'nodeType' => 'comparison',
                        'nodeDriver' => 'truth',
                        'contextKey' => null,
                        'configValue' => null
                    ),
                    'children' => array()
                ),
                array(
                    'segmentId' => '5',
                    'segmentName' => 'Def 4',
                    'Condition' => array(
                        'nodeType' => 'comparison',
                        'nodeDriver' => 'truth',
                        'contextKey' => null,
                        'configValue' => null
                    ),
                    'children' => array(
                        array(
                            'segmentId' => '6',
                            'segmentName' => 'Def 5',
                            'Condition' => array(
                                'nodeType' => 'comparison',
                                'nodeDriver' => 'truth',
                                'contextKey' => null,
                                'configValue' => null
                            ),
                            'children' => array()
                        )
                    )
                )
            )
        ), $this->context);
        $tree = $factory->build();
        $matchingNodes = $tree->runAllLeafNodes();
        $this->assertEquals(count($matchingNodes), 2);
        foreach ($matchingNodes as $node)
        {
            $this->assertTrue($node->isLeafNode());
        }
    }
    
    /**
     * Test enumerating our tree
     * @return void
     */
    public function testEnumerate()
    {
        $enum = $this->tree->enumerate();
        $this->assertEquals($enum, 4);
    }
}
