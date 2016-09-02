<?php

/**
 * Class DigitalPianism_EasyToplinks_Block_Page_Template_Links
 */
class DigitalPianism_EasyToplinks_Block_Page_Template_Links extends Mage_Page_Block_Template_Links {

    /**
     * Change the position of an existing to make the layout customization easier
     * @param $url
     * @param $position
     * @return $this
     */
    public function setPosition($url, $position)
    {
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
     * @param $url
     * @param $name
     * @return $this
     */
    public function rename($url, $name)
    {
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
     * Remove an item by url for Magento < 1.3.0
     * @param $url
     * @return $this
     */
    public function removeLinkByUrl($url)
    {
        if (version_compare(Mage::getVersion(),"1.3.0","<")) {
            foreach ($this->_links as $k => $v) {
                if ($v->getUrl() == $url) {
                    unset($this->_links[$k]);
                }
            }

            return $this;
        } else {
            parent::removeLinkByUrl($url);
        }
    }
}
