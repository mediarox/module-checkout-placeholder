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
        $nodes = $this->fieldFilter->getLabeledFields($jsLayout);
        foreach ($nodes as $node) {
            $this->addPlaceholder($node);
            $jsLayout = $this->arrayManager->merge($node[self::KEY_PATH], $jsLayout, $node);
        }
        return $jsLayout;
    }

    private function addPlaceholder(array &$node): void
    {
        $config = $this->config->getFieldConfig($node[self::KEY_ID], $node[self::KEY_PATH]);
        $override = $config[Config::COLUMN_KEY_PLACEHOLDER] ?? '';
        $label = $override ?: $node[self::KEY_LABEL] ?? false;
        if ($label) {
            $label = ($label instanceof Phrase) ? (string)__($label) : $label;
            $customMark = $this->getRequiredEntryMark($node) ?: $this->getOptionalEntryMark($config);
            $placeholder = $label . ' ' . $customMark;
            $node['config'][Config::COLUMN_KEY_PLACEHOLDER] = trim($placeholder);
        }
    }

    private function getRequiredEntryMark(array &$field): string
    {
        $requiredChar = $this->config->getCustomRequiredMark() ?: '*';
        $isRequiredEntry = isset($field['validation']['required-entry'])
            && $field['validation']['required-entry']
            && $this->config->getEnableRequiredMark();
        return $isRequiredEntry ? $requiredChar : '';
    }

    private function getOptionalEntryMark($config): string
    {
        return $config[Config::SYSTEM_CONFIG_KEY_CUSTOM_OPTIONAL_MARK] ?? '';
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
