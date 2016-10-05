<?php

/**
 * Class DigitalPianism_EasyToplinks_Test_Unit_Block_Page_Template_LinksTest
 */
class DigitalPianism_EasyToplinks_Test_Unit_Block_Page_Template_LinksTest extends \PHPUnit_Framework_TestCase {

    /**
     * New position wanted
     */
    const POSITION_TEST_VALUE = 20;

    /**
     * New label/title wanted
     */
    const NAME_TEST_VALUE = "test2";

    /**
     * Test the setPosition method
     */
    public function testSetPosition()
    {
        $block = $this->_getBlock();

        $this->_addLink($block);

        // Change the position to the wanted value
        $block->setPosition('/test', self::POSITION_TEST_VALUE);

        // Compare the key to the wanted value
        $this->assertEquals($this->_getFirstLinkPosition($block), self::POSITION_TEST_VALUE);
    }

    /**
     * Test the rename method
     */
    public function testRename()
    {
        $block = $this->_getBlock();

        $this->_addLink($block);

        // Rename the link
        $block->rename('/test', self::NAME_TEST_VALUE);

        // Get the link
        $link = $this->_getFirstLink($block);

        // Compare both title and label
        $this->assertEquals($link->getLabel(), self::NAME_TEST_VALUE);
        $this->assertEquals($link->getTitle(), self::NAME_TEST_VALUE);

    }

    /**
     * Create the links block
     */
    protected function _getBlock()
    {
        return new DigitalPianism_EasyToplinks_Block_Page_Template_Links();
    }

    /**
     * Add a link with name and title to test
     */
    protected function _addLink($block)
    {
        $block->addLink(
            'test',
            '/test',
            'test'
        );
    }

    /**
     * Get the first link from the block
     */
    protected function _getFirstLink($block)
    {
        $links = $block->getLinks();
        return current($links);
    }

    /**
     * Get the first link position from the block
     */
    protected function _getFirstLinkPosition($block)
    {
        $links = $block->getLinks();
        return key($links);
    }
}