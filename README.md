### Checkout placeholder
#### Facts
* Enrich all checkout address fields with HTML placeholders (transfer labels).
* Hide all checkout address labels. (less)
* Hide checkout email label. (less)
* "Add placeholder" plugins
    * Magento\Checkout\Block\Checkout\LayoutProcessor::afterProcess (address fields)
    * Magento\Checkout\Block\Checkout\AttributeMerger::afterMerge (email field)
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

![address_before](https://user-images.githubusercontent.com/32567473/134806142-3cc1e49b-2d29-49f6-afef-217fe09a9bef.png)
![address_after](https://user-images.githubusercontent.com/32567473/134806182-049a500f-33fb-4c9c-91db-1fcb34764b3f.png)

#### ToDo's

* Required mark at fields