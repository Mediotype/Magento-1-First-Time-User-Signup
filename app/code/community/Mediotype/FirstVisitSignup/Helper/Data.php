<?php

/**
 *
 * @author      Mediotype
 */
class Mediotype_FirstVisitSignup_Helper_Data extends Mage_Core_Helper_Abstract
{

    const XML_CONFIG_PATH_FIRSTVISIT_ENABLED                = 'mediotype_firstvisit/firstvisit/active';
    const XML_CONFIG_PATH_FIRSTVISIT_BLOCK                  = 'mediotype_firstvisit/firstvisit/block';
    const XML_CONFIG_PATH_FIRSTVISIT_EMAIL_PLACEHOLDER      = 'mediotype_firstvisit/firstvisit/email_placeholder';
    const XML_CONFIG_PATH_FIRSTVISIT_EMAIL_SIGNUP_BUTTON    = 'mediotype_firstvisit/firstvisit/sign_up_button';
    const XML_CONFIG_PATH_FIRSTVISIT_EMAIL_NOTHANKS_BUTTON  = 'mediotype_firstvisit/firstvisit/no_thanks_button';
    const XML_CONFIG_PATH_FIRSTVISIT_LOGO_SRC               = 'design/header/logo_src';
    const XML_CONFIG_PATH_FIRSTVISIT_LOGO_SRC_SMALL         = 'design/header/logo_src_small';
    const XML_CONFIG_PATH_FIRSTVISIT_LOGO_ALT               = 'design/header/logo_alt';

    /**
     * get is active
     * @returbn bool
     */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_ENABLED);
    }

    /**
     * returns cms block id
     * @return int
     */
    public function getCmsBlockIdentifier()
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_BLOCK);
    }

    /**
     *
     * @return mixed
     */
    public function getEmailPlaceholder()
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_EMAIL_PLACEHOLDER);
    }

    /**
     * Get Sign Up Button Text
     * @return string Text for Sign Up Button
     */
    public function getSignUpButton()
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_EMAIL_SIGNUP_BUTTON);
    }

    /**
     * Get No Thanks Button Text
     * @return string Text for No Thanks Button
     */
    public function getNoThanksButton()
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_EMAIL_NOTHANKS_BUTTON);
    }

    /**
     * get store logo url
     * @return string
     */
    public function getLogoSrc()
    {
        return Mage::getDesign()->getSkinUrl(Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_LOGO_SRC));
    }

    /**
     * get store small logo url
     * @return string
     */
    public function getLogoSrcSmall()
    {
        return Mage::getDesign()->getSkinUrl(Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_LOGO_SRC_SMALL));
    }

    /**
     * get store logo alt text
     * @return string
     */
    public function getLogoAlt()
    {
        return Mage::getStoreConfig(self::XML_CONFIG_PATH_FIRSTVISIT_LOGO_ALT);
    }
}
