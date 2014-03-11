Zookal Mock Objects
===================

TL;DR: Transparent autodetecting of disabled core modules and providing mock objects for not breaking Magento. Nothing to configure. No class rewrites. Only one observer. Works out of the box.

If you try to disable e.g. Mage_Newsletter or Mage_Wishlist or ... and you call certain parts of the backend or some rare parts of the frontend you will get errors that Magento cannot find the class XYZ. Best examples are the two previoulsy mentioned. If you have disabled them and you open in the backend a customer entry to edit it, the page will generate an error. Mage_Customer Edit has many dependencies with other modules. So the **Zookal Mock Module** will provide you mock objects which catches all method calls to disabled classes of that modules without breaking anything.

Which modules causes challenges?
--------------------------------

If following modules (until now) are disabled they will then break the rest of the core:

- Mage_Wishlist
- Mage_Review
- Mage_Rating
- Mage_Tag?
- Mage_Log
- Mage_Backup

Only if you would like to disable one of the six modules above then use this mock module.


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

