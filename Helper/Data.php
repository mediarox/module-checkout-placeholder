<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Helper;

use Magento\Framework\Phrase;

class Data
{
    public const KEY_STREET = 'street';

    public function convertFieldList(array &$fieldList): void
    {
        foreach ($fieldList as $key => &$field) {
            if ($this->isStreet($key)) {
                foreach ($field['children'] as &$childField) {
                    $this->addPlaceholder($childField);
                }
                unset($childField);
                continue;
            }
            $this->addPlaceholder($field);
        }
    }
    
    public function isStreet(string $key): bool
    {
        return self::KEY_STREET === $key;
    }
    
    public function addPlaceholder(array &$field): void
    {
        $label = $field['label'] ?? false;
        if ($label) {
            $labelNeedTranslation = ($label instanceof Phrase);
            $label = $labelNeedTranslation ? (string)__($label) : $label;
            $field['placeholder'] = $label . $this->getRequiredEntryMark($field);
        }
    }
    
    public function getRequiredEntryMark(array $field): string
    {
        $isRequiredEntry = $field['validation']['required-entry'] ?? false;
        return $isRequiredEntry ? ' *' : '';
    }
}
