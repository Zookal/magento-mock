Google Checkout and Magento 1.9
-------------------------------

Magento 1.9 does not have anymore a dependency to the `Mage_GoogleCheckout` module
in the `Mage_Sales` module. This can lead to confused backend users because the payment
select drop down can contain an empty entry.

[Discussion in this pull request](https://github.com/Zookal/magento-mock/pull/9).

Add to your config.xml file:

```xml
<global>
     <events>
            <zookal_mock_init_special_methods>
                <observers>
                    <zookal_mymodule>
                        <class>zookal_mymodule/observer</class>
                        <method>mySpecialMethodObserver</method>
                    </zookal_mymodule>
                </observers>
            </zookal_mock_init_special_methods>
        </events>
 </global>
```

and then create your own observer:

```php
class Zookal_MyModule_Model_Observer
{

    public function mySpecialMethodObserver(Varien_Event_Observer $observer)
    {
        /** @var Zookal_Mock_Model_Observer $mock */
        $mock                     = $observer->getMock();
        $m                        = $mock->getSpecialMethods();
        $m['Mage_GoogleCheckout'] = [$this, 'mySpecialMethod'];
        $mock->setSpecialMethods($m);
    }

    public function mySpecialMethod($arg)
    {
        // noop
    }
}
```

This allows you to disable the special method for Google Checkout. Of course you can add now your own methods for
any other module.
