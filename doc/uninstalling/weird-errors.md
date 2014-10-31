I've disabled Mage_[Bundle|Rating|Review|Wishlist|Usa|GiftMessage] but getting a weird error!
----------------------------------------------------

The error is: `Notice: Trying to get property of non-object  in app/code/core/Mage/Core/Model/Config.php on line 1239`.

Digging deeper Mage_Core_Model_Config would like to access `Mage::helper('core')->__()` to display you the error message that
Mage_[Bundle|Rating|Review|Wishlist|Usa] requires the module Mage_XmlConnect. The notice message appears because the core helper is not yet initialized.

So deactivating Mage_XmlConnect works out as the solution. It has many dependencies. Btw: Only if you have the Magento own mobile app you'll need the
XmlConnect module. I'll disable it every time.

### Mage_GiftMessage

If you have disabled and or removed that module you may ran into issues like this:

```
Warning: include() [<a href='function.include'>function.include</a>]: Unable to access 
Mage/Giftmessage/Block/Adminhtml/Product/Helper/Form/Config.php  in .../lib/Varien/Autoload.php on line 93
```

The reason is a typo in the `frontend_input_renderer` column in 
table `catalog_eav_attribute` for attribute code `gift_message_available`.

Magento defaults this value during GiftMessage setup: `giftmessage/adminhtml_product_helper_form_config`
which results later in the class name `Mage_Giftmessage_Block_Adminhtml_Product_Helper_Form_Config` but the folder
name is `app/code/core/Mage/GiftMessage`. The upper and lower M.

**Solution**

If you disable GiftMessage module before installing the Mock Module then the Mock installer will 
correct the name of the input renderer to `giftMessage/adminhtml_product_helper_form_config`.

If you disable GiftMessage after the installation then please either drop/remove yourself 
the attribute `gift_message_available` or simply run this:

```
UPDATE `catalog_eav_attribute` 
    SET xfrontend_input_renderer='' 
    WHERE `attribute_id` = (SELECT attribute_id FROM `eav_attribute` WHERE attribute_code = 'gift_message_availablee') 
```

The typos in the SQL query are on purpose so that you hopefully read this before proceeding.

The better way is to create an install script in one of your `app/code/local/` modules to 
change/remove the attribute `gift_message_available`.
