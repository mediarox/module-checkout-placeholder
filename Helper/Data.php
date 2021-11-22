<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Helper;

use Magento\Framework\Phrase;

class Data
{
    public function convertFieldLabelsIntoPlaceholders(array $fields): array
    {
        foreach ($fields as $key => $field) {
            switch ($key) {
                case 'street':
                    $streetFields = $field['children'];
                    foreach ($streetFields as $streetKey => $streetField) {
                        $this->processField($streetFields, $streetKey, $field);
                    }
                    $fields[$key]['children'] = $streetFields;
                    break;
                default:
                    $this->processField($fields, $key);
                    break;
            }
        }
        return $fields;
    }

    public function processField(array &$fieldArray, $fieldKey, $parentField = null): void
    {
        $currentField = $fieldArray[$fieldKey];
        $this->copyLabelIntoPlaceholder($currentField, $parentField);
        $fieldArray[$fieldKey] = $currentField;
    }

    public function copyLabelIntoPlaceholder(array &$field, $parentField = null): void
    {
        $label = $field['label'] ?? $parentField['label'] ?? false;
        if (!$label) {
            return;
        }
        $labelNeedTranslation = ($label instanceof Phrase);
        $label = $labelNeedTranslation ? (string)__($label) : $label;
        $field['placeholder'] = $label . $this->getRequiredEntryMark($field);
    }

    public function getRequiredEntryMark(array &$field): string
    {
        $isRequiredEntry = $field['validation']['required-entry'] ?? false;
        return $isRequiredEntry ? ' *' : '';
    }
}