<?php

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Helper\Data as PlaceholderHelper;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class PlaceholderProcessor implements LayoutProcessorInterface
{
    public const COMPONENT_SEARCH_KEY = 'searchKey';
    public const COMPONENT_FIELDS_PATH = 'fieldsPath';
    protected array $processList;
    protected ArrayManager $arrayManager;
    protected PlaceholderHelper $placeholderHelper;

    public function __construct(
        array $processList,
        ArrayManager $arrayManager,
        PlaceholderHelper $placeholderHelper
    ) {
        $this->processList = $this->validateProcessList($processList);
        $this->arrayManager = $arrayManager;
        $this->placeholderHelper = $placeholderHelper;
    }

    /**
     * Remove all addresses without COMPONENT_SEARCH_KEY.
     *
     * @param  array $processList
     * @return array
     */
    public function validateProcessList(array $processList): array
    {
        return array_filter($processList, static function ($address) {
            return array_key_exists(self::COMPONENT_SEARCH_KEY, $address);
        });
    }

    /**
     * @param  array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        foreach ($this->processList as $searchSettings) {
            $componentPaths = $this->arrayManager->findPaths($searchSettings[self::COMPONENT_SEARCH_KEY], $jsLayout);
            foreach ($componentPaths as $componentPath) {
                $fullComponentPath = $componentPath . $searchSettings[self::COMPONENT_FIELDS_PATH];
                $fields = $this->arrayManager->get($fullComponentPath, $jsLayout);
                if ($fields) {
                    $this->processFields($fullComponentPath, $fields, $jsLayout);
                }
            }
        }
        return $jsLayout;
    }

    public function processFields(string $fullComponentPath, array $fields, array &$jsLayout): void
    {
        $newFields = $this->placeholderHelper->convertFieldLabelsIntoPlaceholders($fields);
        $jsLayout = $this->arrayManager->merge($fullComponentPath, $jsLayout, $newFields);
    }
}
