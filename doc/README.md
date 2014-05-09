Zookal Mock Objects for Magento
===============================

##### TL;DR: Transparent autodetecting of disabled core modules and extensions and providing mock objects for not breaking Magento. Nothing to configure. No class rewrites. Only one observer. Works out of the box.

If you try to disable e.g. Mage_Newsletter or Mage_Wishlist or ... and you call certain parts of the backend or some rare parts of the
frontend you will get errors that Magento cannot find the class XYZ. Best examples are the two previoulsy mentioned. If you have
disabled them and you open in the backend a customer entry to edit it, the page will generate an error. Mage_Customer Edit has many
dependencies with other modules. So the **Zookal Mock Module** will provide you mock objects which catches all method calls to disabled
classes of that modules without breaking anything.


Author
------

[Cyrill Schumacher](https://github.com/SchumacherFM) - [My pgp public key](http://www.schumacher.fm/cyrill.asc) - [keybase.io/cyrill](https://keybase.io/cyrill)

Made in Sydney, Australia :-)
