Zookal Mock Objects
===================

Transparent autodetecting of disabled core modules and providing mock objects for not breaking Magento.

Nothing to configure. Works out of the box.

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

If following modules (until now) are disabled they then will break the rest of the core:

- Mage_Wishlist
- Mage_Review
- Mage_Rating
- Mage_Tag?
- Mage_Log
- Mage_Backup      

Yes there will be a performance increasement.

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

License
-------
[OSL - Open Software Licence 3.0](http://opensource.org/licenses/osl-3.0.php)

Author
------

[Cyrill Schumacher](https://github.com/SchumacherFM) - [My pgp public key](http://www.schumacher.fm/cyrill.asc)

Made in Sydney, Australia :-)

