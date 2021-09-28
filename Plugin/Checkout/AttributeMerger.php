<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Plugin\Checkout;

use Magento\Checkout\Block\Checkout\AttributeMerger as Subject;
use Checkout\Placeholder\Helper\Data as PlaceholderHelper;

class AttributeMerger
{
    /**
     * Base way to process fields. (if amasty/module-single-step-checkout is not installed)
     * If amasty is installed, the RequiredFlagsProcessor is needed, to process/override fields correctly. 
     * It's nessesary, because of amasty's attribute configuration overlay (database).
     * 
     * @param Subject $subject
     * @param array $result
     * @return array
     */
    public function afterMerge(Subject $subject, $result)
    {
        $placeholderHelper = new PlaceholderHelper();
        return $placeholderHelper->convertFieldLabelsIntoPlaceholders($result);
    }
}