<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Block;

use Magento\Checkout\Block\Checkout\LayoutProcessor;

class LabelsIntoPlaceholdersProcessor
{
    /**
     * @param LayoutProcessor $processor
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(LayoutProcessor $processor, $jsLayout)
    {
        $shippingFieldset = &$jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']
        ['children']['shippingAddress']['children']['shipping-address-fieldset']['children'];
        //$billingConfiguration = &$jsLayout['components']['checkout']['children']['steps']['children']['billing-step']
        //['children']['payment']['children']['payments-list']['children'];
        
        if (isset($shippingFieldset)) {
          $this->processAddress($shippingFieldset);
        }

        return $jsLayout;
    }

    /**
     * @param $addressFields - Address fields.
     * @return array
     */
    private function processAddress($addressFields)
    {
        foreach ($addressFields as $key => $field) {
            $field['placeholder']['label'] = $field['label'];
            $field['label'] = '';
            $addressFields[$key] = $field;
        }
        return $addressFields;
    }
}