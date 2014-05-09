
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
