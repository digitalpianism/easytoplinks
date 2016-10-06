<?php

/**
 * Class DigitalPianism_EasyToplinks_Block_Page_Template_Links
 */
class DigitalPianism_EasyToplinks_Block_Page_Template_Links extends Mage_Page_Block_Template_Links
{

    /**
     * Change the position of an existing to make the layout customization easier
     * @param string $url
     * @param string $position
     * @return $this
     */
    public function setPosition($url, $position)
    {
        $this->_validateSetPosition($url, $position);

        // Get the link and delete it from the current position
        foreach ($this->_links as $k => $v) {
            if ($v->getUrl() == $url) {
                $link = $this->_links[$k];
                unset($this->_links[$k]);
            }
        }

        if (isset($link)) {
            // Add link to new position
            $this->_addIntoPosition($link, $position);
        }

        return $this;
    }

    /**
     * Rename the title and label of a top link
     * @param string $url
     * @param string $name
     * @return $this
     */
    public function rename($url, $name)
    {
        $this->_validateRename($url, $name);

        foreach ($this->_links as $k => $v) {
            if ($v->getUrl() == $url) {
                // Get the link
                $link = $this->_links[$k];
                // Change the label and title
                $link->setLabel($name);
                $link->setTitle($name);
                // Reassign the renamed link
                $this->_links[$k] = $link;
            }
        }

        return $this;
    }

    /**
     * Validate the parameters
     * @param $url
     * @param $name
     * @throws Exception
     */
    protected function _validateRename($url, $name)
    {
        if (is_null($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link because the url cannot be null'));
        } elseif (is_array($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link because the url cannot be an array'));
        } elseif ($url === false) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link because the url cannot be false'));
        } elseif (is_numeric($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link because the url cannot be numeric'));
        }

        if (is_null($name)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link of %s because the label cannot be null', $url));
        } elseif (is_array($name)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link of %s because the label cannot be an array', $url));
        } elseif ($name === false) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to rename top link of %s because the label cannot be false', $url));
        }
    }

    /**
     * Validate the parameters
     * @param $url
     * @param $position
     * @throws Exception
     */
    protected function _validateSetPosition($url, $position)
    {
        if (is_null($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position because the url cannot be null'));
        } elseif (is_array($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position because the url cannot be an array'));
        } elseif ($url === false) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position because the url cannot be false'));
        } elseif (is_numeric($url)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position because the url cannot be numeric'));
        }

        if (is_null($position)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position of %s because the position cannot be null', $url));
        } elseif (is_array($position)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position of %s because the position cannot be an array', $url));
        } elseif ($position === false) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position of %s because the position cannot be false', $url));
        } elseif (is_string($position) && !is_numeric($position)) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position of %s because the position cannot be a string', $url));
        } elseif ($position < 0) {
            throw new Exception(Mage::helper('easytoplinks')->__('Unable to change position of %s because the position cannot be negative', $url));
        }
    }
}