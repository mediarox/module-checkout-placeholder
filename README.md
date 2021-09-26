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

#### Visual - before & after

![address_before](https://user-images.githubusercontent.com/32567473/134806142-3cc1e49b-2d29-49f6-afef-217fe09a9bef.png)
![address_after](https://user-images.githubusercontent.com/32567473/134806182-049a500f-33fb-4c9c-91db-1fcb34764b3f.png)
