Zookal Mock Objects
===================

##### TL;DR: Transparent autodetecting of disabled core modules and extensions and providing mock objects for not breaking Magento. Nothing to configure. No class rewrites. Only one observer. Works out of the box.

If you try to disable e.g. Mage_Newsletter or Mage_Wishlist or ... and you call certain parts of the backend or some rare parts of the frontend you will get errors that Magento cannot find the class XYZ. Best examples are the two previoulsy mentioned. If you have disabled them and you open in the backend a customer entry to edit it, the page will generate an error. Mage_Customer Edit has many dependencies with other modules. So the **Zookal Mock Module** will provide you mock objects which catches all method calls to disabled classes of that modules without breaking anything.

**Uninstalling payment modules**: If you try to remove a payment module (*which has already been used by customers in the checkout*) you cannot open anymore all orders associated with that module. The reason is that the tables `sales_flat_*_payment` contains in the column `method` the method which referers to the model for loading payment relevant informations. Please see below how to uninstall your payment module without touching database tables.

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

How do I disable a module?
--------------------------

Add in your custom app/etc/modules/Vendor_NameSpace.xml

```xml
<config>
    <modules>
        <Mage_ModuleName>
            <active>false</active>
        </Mage_ModuleName>
    </modules>
</config>
```

How do I uninstall a payment module?
------------------------------------

An example would be if you switch from one Stripe payment module to another or changing the credit card payment provider.

Simply delete/uninstall all module relevant files.

In one of your local modules add the following "backup" entry into the config.xml:

```xml
<config>
    <default>
        <payment>
            <paypal_standard>
                <model>zookal_mock/mocks_mage_payment</model>
            </paypal_standard>
            <another_payment_method>
                <model>zookal_mock/mocks_mage_payment</model>
            </another_payment_method>
        </payment>
    </default>
</config>
```
The above xml contains the section where Mage_Paypal module has been disabled and previously used in orders.

No other database updates are required. Clear the caches and check in the backend some orders related to that payment method. You will now see a key/value list of the payment details.

The backend mock payment block has an integrated event `mock_payment_backend_block_to_html_before` with which you can modify the output.

The frontend mock payment block uses the default block `Mage_Core_Block_Abstract` which allows you the usual modifications.

I've disabled and removed Mage_Adminhtml
----------------------------------------

You rock!

Did you remove every Adminhtml area via `$ find . -iname "adminhtml" -type d -exec rm -Rf {} +` ?

Running a backend-less version of Magento saves you processor time, space, speeds up your store and improves security. All missing required adminhtml files will be transparently mocked. Nothing to configure!

#### But how do I maintain a backend-less store?

You have two solutions:

1. Install your backend on a different server (or different path with different domain) and share the same database with the frontend. Security Warning (1).
2. Use on the command line the awesome tool [n98-magerun](http://magerun.net) (2).

(1) If having multiple servers: Make sure that you connect only via SSL encryption to your MySQL server. Someone is spying :-(``

(2) There is currently a feature missing in n98-magerun [https://github.com/netz98/n98-magerun/issues/309](https://github.com/netz98/n98-magerun/issues/309) that you cannot configure `Mage:run()` to use a custom configuration model as explained below.


I've disabled module FooBar but still getting errors regarding dependency?
--------------------------------------------------------------------------

Let's say you disabled Mage_Dataflow but enabled Mage_Catalog and the system is presenting you:

    "Mage_Catalog" requires module "Mage_Dataflow"

You have two possibilities:

1. Edit app/etc/modules/Mage_*.xml and remove the appropriate dependencies.
2. Edit your main index.php file and add this custom config model to `Mage::run()`

```php
Mage::run($mageRunCode, $mageRunType, array(
    'config_model' => 'Zookal_Mock_Model_Config'
));
```

The config model `Zookal_Mock_Model_Config` will automatically resolve invalid dependencies for disabled modules. But some dependency really make sense ;-)

I've disabled Mage_[Bundle|Rating|Review|Wishlist|Usa] but getting a weird error!
----------------------------------------------------

The error is: `Notice: Trying to get property of non-object  in app/code/core/Mage/Core/Model/Config.php on line 1239`.

Digging deeper Mage_Core_Model_Config would like to access `Mage::helper('core')->__()` to display you the error message that
Mage_[Bundle|Rating|Review|Wishlist|Usa] requires the module Mage_XmlConnect. The notice message appears because the core helper is not yet initialized.

So deactivating Mage_XmlConnect works out as the solution. It has many dependencies. Btw: Only if you have the Magento own mobile app you'll need the
XmlConnect module. I'll disable it every time.

I've disabled Mage_Cms!
-----------------------

The catalog system and other routes will still work but you cannot access the root page (/) because that route is provided by Mage_Cms. You only have two solutions:

1. Customize your theme in that way that no one can access (/).
2. Create your own front router by adding an observer to the event `controller_front_init_routers`.

Blocks are also gone.

I've disabled Mage_Shipping but the checkout still won't work
-------------------------------------------------------------

You need to trick the Sales and the Checkout module. You have to place a rewrite of `Mage_Catalog_Model_Product` somewhere in your
codebase or disable the comment in the mocks modules config.xml file.

Add the following method to your `Mage_Catalog_Model_Product` rewrite:

```
    /**
     * @return bool
     */
    public function getIsVirtual()
    {
        return true;
    }
```

Alternatively you can use the class `Zookal_Mock_Model_Catalog_Model_Product` provided by this module.

Do *not* change anything in the database as there are several columns and attributes whose name is `is_virtual` or `virtual`.

Now test your store.

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

Will there be a performance increase?
-------------------------------------

Yes there will be a performance increase due to less loading of classes and xml files.

Examples of deactivation
------------------------

Please see the folder examples.

About
-----

- Extension Key: Zookal_Mock
- Version: 1.0.3
- It's unit tested! :-)
- It runs on production!

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

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Copyright
---------

Copyright (c) Zookal Pty Ltd, Sydney Australia

Author
------

[Cyrill Schumacher](https://github.com/SchumacherFM) - [My pgp public key](http://www.schumacher.fm/cyrill.asc)

Made in Sydney, Australia :-)
