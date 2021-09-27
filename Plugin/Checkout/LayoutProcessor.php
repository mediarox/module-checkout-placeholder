<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\LayoutProcessor as Subject;
use Checkout\Placeholder\Helper\Data as PlaceholderHelper;

class LayoutProcessor
{
    /**
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterProcess(Subject $subject, $result) 
    {
        $placeholderHelper = new PlaceholderHelper();
        
        $layoutRoot = &$result['components']['checkout']['children']['steps']['children']['shipping-step']
                       ['children']['shippingAddress']['children'];
        $placeholderHelper->processField($layoutRoot, 'customer-email');
        return $result;
    }
}