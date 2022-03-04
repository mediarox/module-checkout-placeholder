# Checkout placeholder

## Description
This module is designed to visually change all field pairs (label + field) so that the label is placed inside the field. (As HTML Placeholder incl. "required-entry" mark "*") Additionally you can decide if you want to hide labels, define a custom required mark, hide required marks, customize placeholder text and mark fields as
optional.

Please consider that we are not able to take every third party module into consideration. Fields that are 
not part of a component/are inserted by layout instruction (rendered by template) are not recognized for now.
We plan on investigating this feature in the near future.

We strongly recommend running tests prior to deployment on production environments. 

## Features

* display field label as placeholder
* customize placeholder text
* hide labels
* define a custom required mark
* hide required mark
* mark fields as optional

## Installation
```bash
composer require mediarox/module-checkout-placeholder
bin/magento setup:upgrade
```

## Configuration

### General

**Enable:** Enables the module. After enabling the module placeholder will be set.

**Hide Labels:** Enable this setting to hide labels. (default: disabled)

**Show Required Mark:** Enable to display required marks.(default: enabled)

**Custom Required Mark:** If you want to display a custom required mark enter it here.

**Specific Fields:** To override placeholder content(label text) for specific fields enter the field_id and placeholder you want to display. If you need to customize a field that is used in multiple fieldsets(e.g. firstname) enter an additional, unique fieldset id(e.g. billing-address-form). For street fields use the field_ids `street_0`, `street_1` and `street_2`.

### Optional Fields

**Enable:** If enabled a custom optional mark will be applied to fields configured in 
*Optional Fields*.

**Optional Mark:** Enter your optional text/mark that you want to display here.

**Mark Fields As Optional:** Specify the fields you want to display an optional mark for here. If you need to customize a field that is used in multiple fieldsets(e.g. firstname) enter an additional, unique fieldset id(e.g. billing-address-form). For street fields use the field_ids `street_0`, `street_1` and `street_2`.

## Compatible with

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
