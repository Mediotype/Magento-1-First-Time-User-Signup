<?php
/**
 * @author  @Mediotype
 */
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

//create the default first visit signup block
$firstVisit = Mage::getModel('cms/block');
$firstVisit->setData('title','First Visit Signup Default');
$firstVisit->setData('identifier','firstvisit_default');
$firstVisit->setData('content', '
<img  src="{{skin url="" }}{{config path="design/header/logo_src"}}" alt="{{config path="design/header/logo_alt"}}" />
<p class="block-title">Sign up for our newsletter to get the latest product news and exclusive special offers!</p>
');
$firstVisit->save();

$installer->run("
REPLACE INTO {$this->getTable('cms_block_store')} (`block_id`, `store_id`)
VALUES ({$firstVisit->getData('block_id')},0);
");

$installer->endSetup();
