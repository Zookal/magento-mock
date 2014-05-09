Can I remove the files of the disabled modules?
-----------------------------------------------

Yes you can! And you can even remove

- Mage_AdminNotification
- Mage_Adminhtml
- Mage_Log
- Mage_Shipping
- Mage_Tag

which have hardcoded dependencies through the whole Mage_Adminhtml and other modules code (if adminhtml has not been removed).

The missing models will also be mocked via the PHP set_include_path() method. Fully compatible from Magento 1.1.x
