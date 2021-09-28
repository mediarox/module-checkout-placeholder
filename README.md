### Checkout placeholder
#### Facts
* Enrich all checkout address fields with HTML placeholders (copy labels) incl. "required-entry" mark ("*").
* Enrich checkout email field with HTML placeholder incl. "required-entry" mark ("*").
* Hide all checkout address labels. (less)
* Hide checkout email label. (less)
* "Add placeholder" methods
    * address fields
      * plugin on Magento\Checkout\Block\Checkout\AttributeMerger::afterMerge
      * additional layoutProcessor to re-process fields for other layoutProcessor manipulations like amasty.
    * email field
      * knockout template override
* @see https://devdocs.magento.com/guides/v2.4/howdoi/checkout/checkout_custom_checkbox.html
* "Wer meint, »etwas« oder »jemand« sei nicht an seinem richtigen Platz, übersieht zumeist die Akausalität im Motiv des Platzhalters."

#### Compatibility

* amzn/amazon-pay-magento-2-module:"5.7.1" (knockout email template override)
* amasty/module-single-step-checkout:"3.1.2" (knockout email template override)

#### Installation
```bash
composer require mediarox/module-checkout-placeholder
bin/magento setup:upgrade
```

#### Visual - before & after

![without_extension](https://user-images.githubusercontent.com/32567473/134947126-6cfa3b11-a92b-45a0-90cf-63e7ba042722.png)
![with_extension](https://user-images.githubusercontent.com/32567473/134947141-b6c30ddb-ea68-43cb-a7c9-95df42488056.png)
