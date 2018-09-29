<?php
/**
 *
 * @author      Mediotype
 */
class Mediotype_FirstVisitSignup_Block_Newsletter extends Mage_Core_Block_Template {

    public function _afterToHtml($html)
    {
        if(Mage::helper('mediotype_firstvisit')->isEnabled()) {
            $base = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_DIRECT_LINK);
            $cur = Mage::helper('core/url')->getCurrentUrl();

            $cookie = Mage::getSingleton('core/cookie')->get('has_visited');

            if ($base == $cur) {
                if ($cookie == '' && $cookie != 'True') {
                    Mage::getSingleton('core/cookie')->set('has_visited', 'True', '31536000');
                    return $html;
                }
            }

            $justSubscribed = Mage::getSingleton('core/cookie')->get('subscribed_modal_success');
            if ($justSubscribed == 'True') {
                Mage::getSingleton('core/cookie')->delete('subscribed_modal_success');
                return Mage::app()->getLayout()
                    ->createBlock('core/template')
                    ->setTemplate('mediotype/firstvisit/success.phtml')
                    ->toHtml();
            }
        }
        return '';
    }

    public function getFormUrl() {
        return Mage::getUrl('first-visit-signup/newsletter/subscribe');
    }

}
