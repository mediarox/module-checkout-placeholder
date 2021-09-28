<?php

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Helper\Data as PlaceholderHelper;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;

class RequiredFlagsProcessor implements LayoutProcessorInterface
{
    /**
     * Special way to process fields. (if amasty/module-single-step-checkout is installed)
     * If amasty is installed, the RequiredFlagsProcessor is needed, to process/override fields correctly.
     * It's nessesary, because of amasty's attribute configuration overlay (database).
     *
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $placeholderHelper = new PlaceholderHelper();

        // shipping fields
        if (isset(
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['shipping-address-fieldset']['children']
        )) {
            $fields = $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['shipping-address-fieldset']['children'] = $placeholderHelper->convertFieldLabelsIntoPlaceholders($fields);
        }

        // "billing fields" for case, billing address is moved into shipping address container (amasty checkout, core option ?)
        if (isset(
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
            ['shippingAddress']['children']['billing-address-form']['children']['form-fields']['children']
        )) {
            $fields = $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['billing-address-form']['children']['form-fields']['children'];
            $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
            ['children']['shippingAddress']['children']['billing-address-form']['children']['form-fields']['children'] = $placeholderHelper->convertFieldLabelsIntoPlaceholders($fields);
        }
        
        return $jsLayout;
    }
}
