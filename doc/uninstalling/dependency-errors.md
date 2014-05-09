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
