Zookal Mock Objects
===================

Transparent auto detecting of disabled core modules and providing mock objects for not breaking Magento.

Nothing to configure. No class rewrites. Only one observer. Works out of the box.

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
- and some more ... test it :-)

Only if you would like to disable one of the modules above then use this mock module.

Also we can't delete the database tables from some disabled modules as e.g. CatalogIndex relies von customer_group tables
or Customer relies on some tax tables when tax is disabled.


At Zookal we have the following modules disabled:

- Mage_AdminNotification
- Mage_Authorizenet
- Mage_Backup
- Mage_Captcha
- Mage_Compiler
- Mage_Connect
- Mage_GoogleCheckout
- Mage_GoogleBase
- Mage_Install
- Mage_Log
- Mage_Paypal
- Mage_PaypalUk
- Mage_Poll
- Mage_ProductAlert
- Mage_Review
- Mage_Rating
- Mage_Rss
- Mage_Sendfriend
- Mage_Tag
- Mage_Usa
- Mage_Wishlist
- Mage_XmlConnect
- Phoenix_Moneybookers

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

Will there be a performance increase?
-------------------------------------

Yes there will be a performance increase due to less loading of classes and xml files.

I've disabled Mage_Cms!
-----------------------

The catalog system and other routes will still work but you cannot access the root page (/) because that route is
provided by Mage_Cms. You only have two solutions:

1. Customize your theme in that way that no one can access (/).
2. Create your own front router by adding an observer to the event `controller_front_init_routers`.

Blocks are also gone.

Exmaples
--------

Please see the folder examples.

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Author
------

[Cyrill Schumacher](https://github.com/SchumacherFM) - [My pgp public key](http://www.schumacher.fm/cyrill.asc)

Made in Sydney, Australia :-)

