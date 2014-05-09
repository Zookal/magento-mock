I've disabled Mage_[Bundle|Rating|Review|Wishlist|Usa] but getting a weird error!
----------------------------------------------------

The error is: `Notice: Trying to get property of non-object  in app/code/core/Mage/Core/Model/Config.php on line 1239`.

Digging deeper Mage_Core_Model_Config would like to access `Mage::helper('core')->__()` to display you the error message that
Mage_[Bundle|Rating|Review|Wishlist|Usa] requires the module Mage_XmlConnect. The notice message appears because the core helper is not yet initialized.

So deactivating Mage_XmlConnect works out as the solution. It has many dependencies. Btw: Only if you have the Magento own mobile app you'll need the
XmlConnect module. I'll disable it every time.
