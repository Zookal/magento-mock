# How do I disable a module?

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
