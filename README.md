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

* amzn/amazon-pay-magento-2-module, tested: 5.7.1, 5.9.1
* amasty/module-single-step-checkout, tested: 3.1.2, 3.1.3
* amzn/amazon-pay-module, tested: 4.2.2

#### Wiki

[How do I add a custom checkout field ?](https://github.com/mediarox/module-checkout-placeholder/wiki/How-do-I-add-a-custom-checkout-field-%3F)

#### before

![without_extension](https://user-images.githubusercontent.com/32567473/144977948-00406294-dbf6-4951-9de9-e21c0fc8abc8.jpg)

#### after

![with_extension](https://user-images.githubusercontent.com/32567473/144977092-26bc5720-49cd-4b7f-9a0f-c1329cb99322.jpg)
