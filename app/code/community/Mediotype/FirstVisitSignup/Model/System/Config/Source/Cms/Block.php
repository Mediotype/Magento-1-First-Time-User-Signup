<?php
/**
 *@author   Mediotype
 */
class Mediotype_FirstVisitSignup_Model_System_Config_Source_Cms_Block
{

    protected $_options;

    /**
     * Return Magento option array for select
     *
     * @return array
     */
    public function toOptionArray()
    {
        if (!$this->_options) {
            $res = Array();
            $existingIdentifiers = array();
            $collection = Mage::getModel('cms/block')->getCollection();
            foreach($collection as $block) {
                $identifier = $block->getData('identifier');

                $data['value'] = $identifier;
                $data['label'] = $block->getData('title');

                if (in_array($identifier, $existingIdentifiers)) {
                    $data['value'] .= '|' . $block->getData('page_id');
                } else {
                    $existingIdentifiers[] = $identifier;
                }

                $res[] = $data;
            }
            $this->_options = $res;
        }
        return $this->_options;
    }

}
