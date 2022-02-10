<?php
/**
 * @package   Mediarox_CheckoutPlaceholder
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\Model;

use Checkout\Placeholder\Model\System\Config;
use Magento\Framework\Stdlib\ArrayManager;

class FieldFilter implements PlaceholderInterface
{
    protected array $searchCriteria = [];
    protected ArrayManager $arrayManager;
    protected Config $config;
    private array $customFieldConfig = [];

    public function __construct(
        ArrayManager $arrayManager,
        Config $config,
        array $searchCriteria = []
    ) {
        $this->searchCriteria = $searchCriteria;
        $this->arrayManager = $arrayManager;
        $this->config = $config;
    }

    /**
     * Step 1: Fetch custom field criteria and config values (for specific fields)
     * Step 2: Fetch search criteria (still possible to add via di.xml) and merge field criteria
     *
     * @return array
     */
    private function getSearchCriteria()
    {
        // Step 1
        $this->customFieldConfig = $this->config->getSpecificFieldConfig();
        // Step 2
        $this->searchCriteria = array_merge(
            $this->searchCriteria,
            $this->customFieldConfig,
            $this->config->getSearchCriteria()
        );
        return $this->searchCriteria;
    }

    private function filterInvalidSearchItems(array $searchItems): array
    {
        return array_filter($searchItems, static function ($item) {
            $keyAvailable = $item[self::COMPONENT_SEARCH_KEY] ?? false;
            $pathAvailable = $item[self::COMPONENT_SEARCH_PATH] ?? false;
            return $keyAvailable && $pathAvailable;
        });
    }

    /**
     * Get nodes by search criteria list.
     */
    private function searchNodes(array $searchCriteria, array $jsLayout): \Generator
    {
        foreach ($searchCriteria as $searchCriterion) {
            $componentPaths = $this->arrayManager->findPaths($searchCriterion[self::COMPONENT_SEARCH_KEY], $jsLayout);
            foreach ($componentPaths as $componentPath) {
                $path = $componentPath . $searchCriterion[self::COMPONENT_SEARCH_PATH];
                $node = $this->arrayManager->get($path, $jsLayout);
                if ($node) {
                    $this->addCustomFieldsConfig($node);
                    yield $path => $node;
                }
            }
        }
    }

    private function addCustomFieldsConfig(array &$node)
    {
        foreach ($this->customFieldConfig as $key => $customConfig) {
            if (isset($node[$key])) {
                $node[$key][Config::COLUMN_KEY_PLACEHOLDER_TEXT] = $customConfig[Config::COLUMN_KEY_PLACEHOLDER_TEXT];
            }
        }
    }

    public function getFields(array $jsLayout): \Generator
    {
        return $this->searchNodes($this->filterInvalidSearchItems($this->getSearchCriteria()), $jsLayout);
    }
}
