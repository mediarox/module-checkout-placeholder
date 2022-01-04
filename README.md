### Checkout placeholder
#### Description
This module is designed to visually change all field pairs (label + field) so that the label is placed inside the field. (As HTML Placeholder incl. "required-entry" mark "*")

The following field pairs will be changed:

- All field pairs of the billing address (default luma, amasty checkout)
- All field pairs of the shipping address (default luma, amasty checkout)
- The field pair of the email address (default luma, amasty checkout, amazon pay)
- The field pair of the comment field (amasty checkout)

The labels remain untouched and are hidden via CSS.

#### Installation
```bash
composer require mediarox/module-checkout-placeholder
bin/magento setup:upgrade
```

#### Compatible with

* amzn/amazon-pay-module (deprecated core dependency), tested: 4.2.2
* [amzn/amazon-pay-magento-2-module](https://marketplace.magento.com/amzn-amazon-pay-magento-2-module.html) (up-to-date amazon pay module), tested: 5.7.1, 5.9.1
* [amasty/module-single-step-checkout](https://amasty.com/one-step-checkout-for-magento-2.html), tested: 3.1.2, 3.1.3

#### Wiki

* [How do I add a custom checkout field ?](https://github.com/mediarox/module-checkout-placeholder/wiki/How-do-I-add-a-custom-checkout-field-%3F)
* [What does the checkout look like with the Amasty Checkout module ?](https://github.com/mediarox/module-checkout-placeholder/wiki/What-does-the-checkout-look-like-with-the-Amasty-Checkout-module-%3F)
* [What about Hyvä or the Hyvä Checkout ?](https://github.com/mediarox/module-checkout-placeholder/wiki/What-about-Hyv%C3%A4-or-the-Hyv%C3%A4-Checkout-%3F)

#### Before

![without_extension](https://user-images.githubusercontent.com/32567473/144977948-00406294-dbf6-4951-9de9-e21c0fc8abc8.jpg)

#### After

![with_extension](https://user-images.githubusercontent.com/32567473/144977092-26bc5720-49cd-4b7f-9a0f-c1329cb99322.jpg)
