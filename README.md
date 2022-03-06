# Checkout placeholder

## Description
This module is designed to visually change all field pairs (label + field) so that the label is placed inside the field (As HTML Placeholder incl. "required-entry" mark "*"). Additionally, you can decide if you want to hide labels, define a custom required mark, hide required marks, customize placeholder text and mark fields as
optional.

## Good to know

Most of the fields in the checkout are collected via PHP and rendered dynamically via templates. For example, all input fields via the template `vendor/magento/module-ui/view/frontend/web/templates/form/element/input.html`.
For all these dynamic fields we have created a [LayoutProcessor](https://devdocs.magento.com/guides/v2.4/howdoi/checkout/checkout_custom_checkbox.html) that provides the features described below.

However, there are also fields that cannot be influenced via a LayoutProcessor.
In a standard checkout these would be the fields:
* email
* password
* password confirmation (if available)

These fields are created together in the knockout template `Magento_Checkout/template/form/element/email` and are also not prepared for HTML placeholders by default.
For these fields we provide at the moment only knockout templates overrides, which ensure that always (after installation) the label is used as a placeholder. Including the static required mark "*".

As soon as time or a customer order allows, we would provide these fields with full features as well.

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

STORES > Configuration > MEDIAROX > Checkout Placeholder

### General

#### Enable 
Enables the module. After activation, the field placeholders are filled with the label by default.
* path: checkout_placeholder/general/enable
* default: 0

#### Hide Labels
Enable this setting to hide labels.
* path: checkout_placeholder/general/hide_labels
* default: 0

#### Show Required Mark
Enable to display required marks.
* path: checkout_placeholder/general/enable_required_mark
* default: 1

#### Custom Required Mark
If you want to display a custom required mark enter it here.
* path: checkout_placeholder/general/custom_required_mark
* default: '*'
* depends on: checkout_placeholder/general/enable_required_mark = 1

#### Specific Fields
To override placeholder content (label text) for specific fields enter the field_id and placeholder you want to display. If you need to customize a field that is used in multiple fieldsets (e.g. firstname is available in billing & shipping address) enter an additional, unique fieldset id (e.g. billing-address: 'form-fields', shipping-address: 'shipping-address-fieldset'). For street fields use the field_ids `street_0`, `street_1` and `street_2`.
* path: checkout_placeholder/general/specific_fields
* default: ''

### Optional Fields

#### Enable:
If enabled a custom optional mark will be applied to fields configured in *Optional Fields*.
* path: checkout_placeholder/optional_marks/enable
* default: 0

#### Optional Mark:
Enter your optional text/mark that you want to display here.
* path: checkout_placeholder/optional_marks/custom_optional_mark
* default: ''

#### Mark Fields As Optional:
Specify the fields you want to display an optional mark for here. If you need to customize a field that is used in multiple fieldsets (e.g. firstname is available in billing & shipping address) enter an additional, unique fieldset id (e.g. billing-address: 'form-fields', shipping-address: 'shipping-address-fieldset'). For street fields use the field_ids `street_0`, `street_1` and `street_2`.
* path: checkout_placeholder/optional_marks/optional_fields
* default: ''

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
