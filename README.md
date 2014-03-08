Zookal Mock Objects
===================

Transparent autodetecting of disabled core modules and providing mock objects for not breaking Magento.

Nothing to configure. No class rewrites. Only one observer. Works out of the box.

Which modules causes challenges?
--------------------------------

If following modules (until now) are disabled they will then break the rest of the core:

- Mage_Wishlist
- Mage_Review
- Mage_Rating
- Mage_Tag
- Mage_Tax
- Mage_Log
- Mage_Backup
- Mage_Customer
- Mage_Catalog

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

Add in your custom app/etc/modules/customer_module.xml

```xml
<config>
    <modules>
        <Mage_ModuleName>
            <active>false</active>
        </Mage_ModuleName>
    </modules>
</config>
```

Will there be a performance increase?
-------------------------------------

Yes there will be a performance increasement due to less loading of classes and xml files.

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Author
------

[Cyrill Schumacher](https://github.com/SchumacherFM) - [My pgp public key](http://www.schumacher.fm/cyrill.asc)

Made in Sydney, Australia :-)

