<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Model\FieldFilter;
use Checkout\Placeholder\Model\PlaceholderInterface;
use Checkout\Placeholder\Model\System\Config;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Phrase;
use Magento\Framework\Stdlib\ArrayManager;

class PlaceholderProcessor implements LayoutProcessorInterface, PlaceholderInterface
{
    public const KEY_STREET = 'street';
    protected ArrayManager $arrayManager;
    protected FieldFilter $fieldFilter;
    protected Config $config;

    public function __construct(
        FieldFilter $fieldFilter,
        ArrayManager $arrayManager,
        Config $config
    ) {
        $this->arrayManager = $arrayManager;
        $this->fieldFilter = $fieldFilter;
        $this->config = $config;
    }

    /**
     * Search and convert all field lists.
     */
    private function processFields(array $jsLayout): array
    {
        $nodes = $this->fieldFilter->getFields($jsLayout);
        foreach ($nodes as $path => $node) {
            if (isset($node['component'])) {
                $node['single'] = 1;
                $node = [$node];
            }
            $this->convertFieldList($node);
            if (count($node) === 1 && $node[0]['single']) {
                $node = array_pop($node);
            }
            $jsLayout = $this->arrayManager->merge($path, $jsLayout, $node);
        }
        return $jsLayout;
    }

    private function convertFieldList(array &$fieldList): void
    {
        foreach ($fieldList as $key => &$field) {
            if (self::KEY_STREET === $key) {
                $this->convertFieldList($field['children']);
            }
            $this->addPlaceholder($field);
        }
    }

    private function addPlaceholder(array &$field): void
    {
        $override = isset($field[Config::COLUMN_KEY_PLACEHOLDER_TEXT]);
        $label = $override ? $field[Config::COLUMN_KEY_PLACEHOLDER_TEXT] : $field['label'] ?? false;
        if ($label) {
            $labelNeedTranslation = ($label instanceof Phrase);
            $label = $labelNeedTranslation ? (string)__($label) : $label;
            $field['placeholder'] = $label . $this->getRequiredEntryMark($field);
        }
    }

    private function getRequiredEntryMark(array &$field): string
    {
        $requiredChar = $this->config->getCustomRequiredMark() ?: ' *';
        $isRequiredEntry = isset($field['validation']['required-entry'])
            && $field['validation']['required-entry']
            && $this->config->getEnableRequiredMark();
        return $isRequiredEntry ? $requiredChar : '';
    }

    /**
     * Processor init.
     *
     * @param  array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        return $this->config->getEnable() ? $this->processFields($jsLayout) : $jsLayout;
    }
}
