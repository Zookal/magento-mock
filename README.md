Zookal Mock Objects
===================

##### TL;DR: Transparent autodetecting of disabled core modules and providing mock objects for not breaking Magento. Nothing to configure. No class rewrites. Only one observer. Works out of the box.

If you try to disable e.g. Mage_Newsletter or Mage_Wishlist or ... and you call certain parts of the backend or some rare parts of the frontend you will get errors that Magento cannot find the class XYZ. Best examples are the two previoulsy mentioned. If you have disabled them and you open in the backend a customer entry to edit it, the page will generate an error. Mage_Customer Edit has many dependencies with other modules. So the **Zookal Mock Module** will provide you mock objects which catches all method calls to disabled classes of that modules without breaking anything.

**Uninstalling payment modules**: If you try to remove a payment module (*which has already been used by customers in the checkout*) you cannot open anymore all orders associated with that module. The reason is that the tables `sales_flat_*_payment` contains in the column `method` the method which referers to the model for loading payment relevant informations. Please see below how to uninstall your payment module without touching database tables.

Which modules causes challenges?
--------------------------------

If one or all of the following modules (until now) are disabled they will then break the rest of the core:

- Mage_Wishlist
- Mage_Review
- Mage_Rating
- Mage_Tag
- Mage_Tax
- Mage_Log
- Mage_Backup
- Mage_Customer
- Mage_Checkout
- Mage_Sales
- Mage_Cms
- Mage_Catalog
- All payment modules
- and some more ... test it :-)

Only if you would like to disable one of the modules above then use this mock module.

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

Simply delete all module relevant files.

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
The abouve xml contains the section where Mage_Paypal module has been disabled and previously used in orders. 

No other database updates are required. Clear the caches and check in the backend some orders related to that payment method.


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

The catalog system and other routes will still work but you cannot access the root page (/) because that route is
provided by Mage_Cms. You only have two solutions:

1. Customize your theme in that way that no one can access (/).
2. Create your own front router by adding an observer to the event `controller_front_init_routers`.

Blocks are also gone.

Will there be a performance increase?
-------------------------------------

Yes there will be a performance increase due to less loading of classes and xml files.

Examples of deactivation
------------------------

Please see the folder examples.

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
