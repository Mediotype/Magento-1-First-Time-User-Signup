<?php
/**
 *
 * @author      Mediotype
 */
class Mediotype_FirstVisitSignup_NewsletterController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        if(!Mage::helper('mediotype_firstvisit')->isEnabled()){
            $this->_redirect('noroute');
        }
    }

    public function subscribeAction()
    {
        if(Mage::helper('mediotype_firstvisit')->isEnabled() == false) {
            $this->_redirectReferer();
            return;
        }

        $email = $this->getRequest()->getParam('email');
        $session = Mage::getSingleton('core/session');
        $customerSession = Mage::getSingleton('customer/session');

        try {
            if (!Zend_Validate::is($email, 'EmailAddress')) {
                Mage::throwException($this->__('Please enter a valid email address.'));
            }

            if (Mage::getStoreConfig(Mage_Newsletter_Model_Subscriber::XML_PATH_ALLOW_GUEST_SUBSCRIBE_FLAG) != 1 &&
                !$customerSession->isLoggedIn()) {
                Mage::throwException($this->__('Sorry, but administrator denied subscription for guests. Please <a href="%s">register</a>.', Mage::helper('customer')->getRegisterUrl()));
            }

            $ownerId = Mage::getModel('customer/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByEmail($email)
                ->getId();
            if ($ownerId !== null && $ownerId != $customerSession->getId()) {
                Mage::throwException($this->__('This email address is already subscribed.'));
            }

            // $subscriber = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
            // /** @var $subscriber Mage_Newsletter_Model_Subscriber */
            // $subscribeId = $subscriber->getId();

            $status = Mage::getModel('newsletter/subscriber')->subscribe($email);
            if ($status == Mage_Newsletter_Model_Subscriber::STATUS_NOT_ACTIVE) {
                $session->addSuccess($this->__('Confirmation request has been sent.'));
                Mage::getSingleton('core/cookie')->set('subscribed_modal_success', 'True', '31536000');
            }
            else {
                Mage::getSingleton('core/cookie')->set('subscribed_modal_success', 'True', '31536000');
                $session->addSuccess($this->__('Thank you for your subscription.'));
            }
        }
        catch (Mage_Core_Exception $e) {
            $session->addException($e, $this->__('There was a problem with the subscription: %s', $e->getMessage()));
        }
        catch (Exception $e) {
            $session->addException($e, $this->__('There was a problem with the subscription.'));
        }

        $this->_redirectReferer();
    }
}
