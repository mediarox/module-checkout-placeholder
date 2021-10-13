<?php

namespace Checkout\Placeholder\Block\Onepage;

use Checkout\Placeholder\Helper\Data as PlaceholderHelper;
use Magento\Checkout\Block\Checkout\LayoutProcessorInterface;
use Magento\Framework\Stdlib\ArrayManager;

class PlaceholderProcessor implements LayoutProcessorInterface
{
    public const ADDRESS_SEARCH_KEY = 'searchKey';
    public const ADDRESS_FIELDS_PATH = 'fieldsPath';
    
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
        return array_filter($processAddressList, static function ($address) {
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
            $addressPaths = $this->arrayManager->findPaths($searchSettings[self::ADDRESS_SEARCH_KEY], $jsLayout);
            foreach($addressPaths as $addressPath) {
                $fullAddressPath = $addressPath . $searchSettings[self::ADDRESS_FIELDS_PATH];
                $addressFields = $this->arrayManager->get($fullAddressPath, $jsLayout);
                if($addressFields) {
                    $this->processFields($fullAddressPath, $addressFields, $jsLayout);
                }
            }
        }
        return $jsLayout;
    }
    
    public function processFields(string $addressPath, array $fields, array &$jsLayout): void
    {
        $newAddressFields = $this->placeholderHelper->convertFieldLabelsIntoPlaceholders($fields);
        $jsLayout = $this->arrayManager->merge($addressPath, $jsLayout, $newAddressFields);
    }
}
