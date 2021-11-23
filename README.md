### Checkout placeholder
#### Description
This module is designed to visually change all field pairs (label + field) so that the label is placed inside the field. (As HTML Placeholder incl. "required-entry" mark "*")

The following field pairs will be changed:

- All field pairs of the billing address
- All field pairs of the shipping address
- The field pair of the email address
- The field pair of the comment field

The labels remain untouched and are hidden via CSS.

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

#### ToDo's
* handling different count of street lines
    * 1 = parent field label
    * \> 1 = current field label ?
* required mark string as config
