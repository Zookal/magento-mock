History
-------

### 1.1.4

Bug fix for Weee Helper `->getApplied()` to return an array. Fixes issue No 5.

### 1.1.3

Add observers for cron events to properly mock stuff. Implemented singleton pattern because of cron
events `always` and `default`.

### 1.1.2

Bugfix to convert catalog_product attribute gift_message_available
from `giftmessage/adminhtml_product_helper_form_config` to `giftMessage/adminhtml_product_helper_form_config`
to find the class in the case-sensitive file system. This only applies if Mage_GiftMessage is
disabled before installing Mock Module.

### 1.1.1

- Merged PR [Issue 3](https://github.com/Zookal/magento-mock/issues/3) Disabled Mage_Weee fixes

### 1.1.0

- Major internal refactorings because of Scrutinizer CI integration

### 1.0.6

- Add Mock for Mage_Downloadable_Model_Product_Type (if you have M2ePro installed)

### 1.0.5

- Add Mock for Mage_AdminNotification_Model_Inbox with loggin output into a file (if you have M2ePro installed)

#### 1.0.4

- Adding Mage_Admin_Model_User when Mage_Admin has been removed
- Bugfix: Added Wishlist model and its collection for iteration
- Added abstract iteration class

#### 1.0.3

- Added Mage_Shipping mocks. Please read documentation how to properly disable this module
- Removed entry in $_dependencyLiars because Mage_Catalog needs Mage_Dataflow in checkout->order->save()

#### 1.0.2

- Added Mage_CatalogInventory
- Added Mage_Usa fallback model. Errors occur when loading system/config section and files of Mage_Usa have been removed,
and when trying to create a new shipment in Sales -> Orders

#### 1.0.1

- Added Mage_Weee mocks
- Added Mage_GiftMessage mocks
- Possibility to run mock module in a shell script

#### 1.0.0

- Initial Release
