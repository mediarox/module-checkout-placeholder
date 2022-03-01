<?php
/**
 * @package   Mediarox_ConfigurableProductsInfoSwitcher
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

namespace Checkout\Placeholder\Model\System;

interface ConfigInterface
{
    const SYSTEM_CONFIG_BASE_PATH_GENERAL = 'checkout_placeholder/general/';
    const SYSTEM_CONFIG_KEY_ENABLE = 'enable';
    const SYSTEM_CONFIG_KEY_ENABLE_REQUIRED_MARK = 'enable_required_mark';
    const SYSTEM_CONFIG_KEY_CUSTOM_REQUIRED_MARK = 'custom_required_mark';
    const SYSTEM_CONFIG_KEY_SPECIFIC_FIELDS = 'specific_fields';

    const SYSTEM_CONFIG_BASE_PATH_OPTIONAL_MARKS = 'checkout_placeholder/optional_marks/';
    const SYSTEM_CONFIG_KEY_OPTIONAL_FIELDS = 'optional_fields';
    const SYSTEM_CONFIG_KEY_CUSTOM_OPTIONAL_MARK = 'custom_optional_mark';
    const DEFAULT_OPTIONAL_MARK = '(optional)';

    const COLUMN_KEY_STREET_PREFIX = 'street_';
    const COLUMN_KEY_FIELD_ID = 'field_id';
    const COLUMN_KEY_PLACEHOLDER = 'placeholder';
    const COLUMN_KEY_FIELDSET_ID = 'fieldset_id';
    const COLUMN_KEY_SEARCH_KEY = 'searchKey';
}
