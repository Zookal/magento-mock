History
-------

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
