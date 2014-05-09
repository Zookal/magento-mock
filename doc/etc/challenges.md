Which modules or extensions causes challenges?
--------------------------------

If one or all of the following modules (until now) are disabled they will then break the rest of the core:

- Mage_Wishlist
- Mage_Weee
- Mage_Review
- Mage_Rating
- Mage_Tag
- Mage_Tax
- Mage_Shipping
- Mage_Log
- Mage_Backup
- Mage_Customer
- Mage_Checkout
- Mage_Sales
- Mage_Cms
- Mage_Catalog
- Mage_Adminhtml
- Mage_GiftMessages
- Mage_GoogleCheckout
- All non Mage_* payment modules
- and some more ... test it :-)

The Mage_Payment module itself cannot be disabled and mocked because it is too tight couple with Mage_Sales and Mage_Checkout.

Also we can't delete the database tables from some disabled modules as e.g. CatalogIndex relies von customer_group tables
or Customer relies on some tax tables when tax is disabled.

At Zookal we have the following modules disabled: Mage_AdminNotification, Mage_Authorizenet, Mage_Backup, Mage_Captcha, Mage_Compiler, Mage_Connect,
Mage_GoogleCheckout, Mage_GoogleBase, Mage_Install, Mage_Log, Mage_Paypal, Mage_PaypalUk, Mage_Poll, Mage_ProductAlert, Mage_Review, Mage_Rating,
Mage_Rss, Mage_Sendfriend, Mage_Tag, Mage_Usa, Mage_Wishlist, Mage_XmlConnect, Phoenix_Moneybookers.
