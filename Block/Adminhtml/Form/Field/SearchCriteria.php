<?php
/**
 * @package   Checkout_Placeholder
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\Block\Adminhtml\Form\Field;

use Checkout\Placeholder\Model\PlaceholderInterface;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class SearchCriteria extends AbstractFieldArray implements PlaceholderInterface
{
    protected function _prepareToRender()
    {
        $this->addColumn(
            'id',
            [
                'label' => __('ID'),
            ]
        );
        $this->addColumn(
            self::COMPONENT_SEARCH_KEY,
            [
                'label' => __('Search Key'),
            ]
        );
        $this->addColumn(
            self::COMPONENT_SEARCH_PATH,
            [
                'label' => __('Path'),
            ]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
