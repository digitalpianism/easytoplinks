<?php

class DigitalPianism_EasyToplinks_Test_Unit_Block_Page_Template_LinksTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validPositionsProvider
     */
    public function testSetValidPosition($url, $position)
    {
        $block = $this->_createTemplateLinksBlockWithLink();

        $block->setPosition($url, $position);

        $this->assertEquals($this->_getThePositionFromTheFirstLinkOfTheBlock($block), $position);
    }

    public function validPositionsProvider()
    {
        return array(
            'normal behavior'       => array('/test-url', 20),
            'string position'       => array('/test-url', '20'),
        );
    }

    /**
     * @dataProvider invalidPositionsProvider
     * @expectedException Exception
     * @expectedExceptionMessageRegExp /Unable to change position \w+/
     */
    public function testSetInvalidPosition($url, $position)
    {
        $block = $this->_createTemplateLinksBlockWithLink();

        $block->setPosition($url, $position);
    }

    public function invalidPositionsProvider()
    {
        return array(
            'null position'         => array('/test-url', null),
            'bool position'         => array('/test-url', false),
            'non numeric position'  => array('/test-url', 'foo'),
            'negative position'     => array('/test-url', -1),
            'array position'        => array('/test-url', array()),
            'null url'              => array(null, 20),
            'bool url'              => array(false, 20),
            'numeric url'           => array(20, 20),
            'array url'             => array(array(), 20),
        );
    }

    /**
     * @dataProvider validLabelProvider
     */
    public function testValidRename($url, $label)
    {
        $block = $this->_createTemplateLinksBlockWithLink();

        $block->rename($url, $label);

        $link = $this->_getTheFirstLinkFromTheBlock($block);

        $this->assertEquals($link->getLabel(), $label);
        $this->assertEquals($link->getTitle(), $label);

    }

    public function validLabelProvider()
    {
        return array(
            'normal behavior'       => array('/test-url', 'New Label'),
            'numeric label'         => array('/test-url', 10),
            'negative label'        => array('/test-url', -1),
        );
    }

    /**
     * @dataProvider invalidLabelProvider
     * @expectedException Exception
     * @expectedExceptionMessageRegExp /Unable to rename top link \w+/
     */
    public function testInvalidRename($url, $label)
    {
        $block = $this->_createTemplateLinksBlockWithLink();

        $block->rename($url, $label);
    }

    public function invalidLabelProvider()
    {
        return array(
            'null label'            => array('/test-url', null),
            'boolean label'         => array('/test-url', false),
            'array label'           => array('/test-url', array()),
            'null url'              => array(null, 'New Label'),
            'bool url'              => array(false, 'New Label'),
            'numeric url'           => array(20, 'New Label'),
            'array url'             => array(array(), 'New Label'),
        );
    }

    private function _createTemplateLinksBlockWithLink()
    {
        $block = new DigitalPianism_EasyToplinks_Block_Page_Template_Links();

        $this->_addLink($block);

        return $block;
    }

    private function _addLink(DigitalPianism_EasyToplinks_Block_Page_Template_Links $block)
    {
        $block->addLink(
            'Test Label',
            '/test-url',
            'Test Title'
        );
    }

    private function _getTheFirstLinkFromTheBlock(DigitalPianism_EasyToplinks_Block_Page_Template_Links $block)
    {
        $links = $block->getLinks();
        return current($links);
    }

    private function _getThePositionFromTheFirstLinkOfTheBlock(DigitalPianism_EasyToplinks_Block_Page_Template_Links $block)
    {
        $links = $block->getLinks();
        return key($links);
    }
}