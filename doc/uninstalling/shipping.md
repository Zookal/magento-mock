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
