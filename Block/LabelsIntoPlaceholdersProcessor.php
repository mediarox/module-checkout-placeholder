<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Block;

use Magento\Checkout\Block\Checkout\AttributeMerger;
use Magento\Framework\Phrase;

class LabelsIntoPlaceholdersProcessor
{
    /**
     * @param AttributeMerger $subject
     * @param array $result
     * @return array
     * @see Magento\Checkout\Block\Checkout\AttributeMerger::merge
     */
    public function afterMerge(AttributeMerger $subject, $result)
    {
        foreach ($result as $key => $field) {
            if('street' == $key) {
                $streetFields = $field['children'];
                foreach($streetFields as $streetKey => $streetField) {
                    $streetField = $this->processField($streetField, $field['label'] ?? null);
                    $streetFields[$streetKey] = $streetField;
                }
                $result[$key] = $this->resetLabel($field); // clear parent node label
                $result[$key]['children'] = $streetFields;
            }
            else {
               $addressField = $this->processField($field);
               $result[$key] = $addressField;
            }
        }
        return $result;
    }
    
    public function processField($field, $parentLabel = null) {
        $labelObject = $parentLabel ?? $field['label'] ?? false;
        if($labelObject) {
            $labelText = $labelObject->getText();
            $field['placeholder'] = __($labelText);
            $field = $this->resetLabel($field);
        }
        return $field;
    }
    
    public function resetLabel($field)
    {
        $field['label'] = new Phrase('');
        return $field;
    }
}