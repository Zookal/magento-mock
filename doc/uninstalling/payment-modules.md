
How do I uninstall a payment module?
------------------------------------

An example would be if you switch from one Stripe payment module to another or changing the credit card payment provider.

Simply delete/uninstall all module relevant files.

In one of your local modules add the following "backup" entry into the config.xml:

```xml
<config>
    <default>
        <payment>
            <paypal_standard>
                <model>zookal_mock/mocks_mage_payment</model>
            </paypal_standard>
            <another_payment_method>
                <model>zookal_mock/mocks_mage_payment</model>
            </another_payment_method>
        </payment>
    </default>
</config>
```
The above xml contains the section where Mage_Paypal module has been disabled and previously used in orders.

No other database updates are required. Clear the caches and check in the backend some orders related to that payment method. You will now see a key/value list of the payment details.

The backend mock payment block has an integrated event `mock_payment_backend_block_to_html_before` with which you can modify the output.

The frontend mock payment block uses the default block `Mage_Core_Block_Abstract` which allows you the usual modifications.
