<?php
/**
 * Copyright 2021 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * See LICENSE for license details.
 */
declare(strict_types=1);

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Helper\Data as PlaceholderHelper;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class PlaceholderProcessor implements LayoutProcessorInterface
{
    public const COMPONENT_SEARCH_KEY = 'searchKey';
    public const COMPONENT_SEARCH_PATH = 'path';
    protected array $fieldLists;
    protected array $fields;
    protected ArrayManager $arrayManager;
    protected PlaceholderHelper $placeholderHelper;

    public function __construct(
        array $fieldLists,
        array $fields,
        ArrayManager $arrayManager,
        PlaceholderHelper $placeholderHelper
    ) {
        $this->fieldLists = $this->filterInvalidSearchItems($fieldLists);
        $this->fields = $this->filterInvalidSearchItems($fields);
        $this->arrayManager = $arrayManager;
        $this->placeholderHelper = $placeholderHelper;
    }
    
    /**
     * Remove not qualified search items.
     *
     * @param  array $searchItems
     * @return array
     */
    public function filterInvalidSearchItems(array $searchItems): array
    {
        return array_filter($searchItems, static function ($item) {
            $keyAvailable = $item[self::COMPONENT_SEARCH_KEY] ?? false;
            $pathAvailable = $item[self::COMPONENT_SEARCH_PATH] ?? false;
            return $keyAvailable && $pathAvailable;
        });
    }

    /**
     * @param  array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        $this->processFieldLists($jsLayout);
        $this->processFields($jsLayout);
        return $jsLayout;
    }

    /**
     * Get nodes by search criteria list.
     */
    protected function searchNodes(array $searchCriteria, array $jsLayout): \Generator
    {
        foreach($searchCriteria as $searchCriterion) {
            $componentPaths = $this->arrayManager->findPaths($searchCriterion[self::COMPONENT_SEARCH_KEY], $jsLayout);
            foreach ($componentPaths as $componentPath) {
                $path = $componentPath . $searchCriterion[self::COMPONENT_SEARCH_PATH];
                $node = $this->arrayManager->get($path, $jsLayout);
                if($node) {
                    yield $path => $node;
                }
            }
        }
    }
    
    /**
     * Search and convert all field lists.
     * 
     * @param $jsLayout
     */
    public function processFieldLists(&$jsLayout): void 
    {
        foreach($this->searchNodes($this->fieldLists, $jsLayout) as $path => $node) {
            $this->placeholderHelper->convertFieldList($node);
            $jsLayout = $this->arrayManager->merge($path, $jsLayout, $node);
        };
    }

    /**
     * Search and convert all specific fields.
     * 
     * @param $jsLayout
     */
    public function processFields(&$jsLayout): void
    {
        foreach($this->searchNodes($this->fields, $jsLayout) as $path => $node) {
            $this->placeholderHelper->addPlaceholder($node);
            $jsLayout = $this->arrayManager->merge($path, $jsLayout, $node);
        }
    }
}
