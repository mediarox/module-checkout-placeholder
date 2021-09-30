<?php

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Helper\Data as PlaceholderHelper;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class PlaceholderProcessor implements LayoutProcessorInterface
{
    const ADDRESS_SEARCH_KEY = 'searchKey';
    const ADDRESS_FIELDS_PATH = 'fieldsPath';
    
    protected array $processAddressList;
    protected ArrayManager $arrayManager;
    protected PlaceholderHelper $placeholderHelper;
    
    public function __construct(
        array $processAddressList,
        ArrayManager $arrayManager,
        PlaceholderHelper $placeholderHelper
    ) 
    {
        $this->processAddressList = $this->validateProcessAddressList($processAddressList);
        $this->arrayManager = $arrayManager;
        $this->placeholderHelper = $placeholderHelper;
    }

    /**
     * Remove all addresses without ADDRESS_SEARCH_KEY.
     * 
     * @param array $processAddressList
     * @return array
     */
    public function validateProcessAddressList(array $processAddressList): array 
    {
        return array_filter($processAddressList, function ($address) {
            return array_key_exists(self::ADDRESS_SEARCH_KEY, $address);
        });
    }
    
    /**
     * @param array $jsLayout
     * @return array
     */
    public function process($jsLayout)
    {
        foreach($this->processAddressList as $name => $searchSettings) {
            $addressFieldsPath = $this->findAddressFieldsPath($searchSettings, $jsLayout);
            if($addressFieldsPath) {
                $this->processFields($addressFieldsPath, $jsLayout);
            }
        }
        return $jsLayout;
    }
    
    public function findAddressFieldsPath(array $searchSettings, array $jsLayout): ?string
    {
        $addressPath = $this->arrayManager->findPath($searchSettings[self::ADDRESS_SEARCH_KEY], $jsLayout);
        $addressPathNotFound = (null === $addressPath);
        if($addressPathNotFound) {
            return null;
        }
        $addressPath .= $searchSettings[self::ADDRESS_FIELDS_PATH] ?? '';
        return $addressPath;
    }
    
    public function processFields(string $fieldsPath, array &$jsLayout): void
    {
        $addressFields = $this->arrayManager->get($fieldsPath, $jsLayout); 
        $newAddressFields = $this->placeholderHelper->convertFieldLabelsIntoPlaceholders($addressFields);
        $jsLayout = $this->arrayManager->merge($fieldsPath, $jsLayout, $newAddressFields);
    }
}
