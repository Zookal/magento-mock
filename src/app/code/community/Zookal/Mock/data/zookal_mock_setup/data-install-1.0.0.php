<?php
/**
 * @category    Zookal_Mock
 * @package     Model
 * @author      Cyrill Schumacher | {firstName}@{lastName}.fm | @SchumacherFM
 * @copyright   Copyright (c) Zookal Pty Ltd
 * @license     OSL - Open Software Licence 3.0 | http://opensource.org/licenses/osl-3.0.php
 */

/** @var Mage_Eav_Model_Entity_Setup $installer */
$installer = $this;

if (false === Mage::helper('core')->isModuleEnabled('Mage_GiftMessage')) {
    $installer->startSetup();
    /** @var Mage_Catalog_Model_Resource_Setup $cs */
    $cs = Mage::getResourceModel('catalog/setup', 'catalog_setup');

    /**
     * Update input_renderer giftmessage/adminhtml_product_helper_form_config
     * because module name is spelled wrong: should be giftMessage/adminhtml_product_helper_form_config
     * with an upper M.
     *
     * Alternatively you can fully drop the attribute gift_message_available if you don't use it.
     */
    $cs->updateAttribute(
        Mage_Catalog_Model_Product::ENTITY,
        'gift_message_available',
        'frontend_input_renderer',
        'giftMessage/adminhtml_product_helper_form_config'
    );
    $installer->endSetup();
}
