<?php
/**
 * @package   Mediarox_CheckoutPlaceholder
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\Block\Adminhtml\Form\Field;

use Checkout\Placeholder\Model\System\ConfigInterface;
use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class OptionalFieldConfig extends AbstractFieldArray implements ConfigInterface
{
    protected function _prepareToRender()
    {
        $this->addColumn(
            self::COLUMN_KEY_FIELD_ID,
            ['label' => __('Field ID')]
        );
        $this->addColumn(
            self::COLUMN_KEY_FIELDSET_ID,
            ['label' => __('Fieldset ID')]
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
