### Checkout placeholder
#### Facts
* Converts all checkout address field labels to the HTML placeholder syntax.
* Via plugin on Magento\Checkout\Block\Checkout\LayoutProcessor (afterProcess). 
* Template: https://devdocs.magento.com/guides/v2.4/howdoi/checkout/checkout_custom_checkbox.html

#### Installation
```bash
composer require mediarox/module-checkout-placeholder
bin/magento setup:upgrade
```