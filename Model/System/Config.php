<?php
/**
 * @package   Mediarox_ConfigurableProductsInfoSwitcher
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\Model\System;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config implements ConfigInterface
{
    protected StoreManagerInterface $storeManager;
    protected ScopeConfigInterface $scopeConfig;
    protected Json $json;

    public function __construct(StoreManagerInterface $storeManager, ScopeConfigInterface $scopeConfig, Json $json)
    {
        $this->storeManager = $storeManager;
        $this->scopeConfig = $scopeConfig;
        $this->json = $json;
    }

    public function getConfigValue(string $key)
    {
        return $this->scopeConfig->getValue(
            self::SYSTEM_CONFIG_BASE_PATH_GENERAL . $key,
            ScopeInterface::SCOPE_STORE,
            $this->storeManager->getStore()
        );
    }

    public function getEnable(): int
    {
        return (int)$this->getConfigValue(self::SYSTEM_CONFIG_KEY_ENABLE);
    }

    public function getCustomRequiredMark(): string
    {
        return $this->getConfigValue(self::SYSTEM_CONFIG_KEY_CUSTOM_REQUIRED_MARK);
    }

    public function getEnableRequiredMark(): int
    {
        return (int)$this->getConfigValue(self::SYSTEM_CONFIG_KEY_ENABLE_REQUIRED_MARK);
    }

    public function getSpecificFieldConfig(): array
    {
        $systemValues = $this->getConfigValue(self::SYSTEM_CONFIG_KEY_SPECIFIC_FIELDS) ?
            $this->json->unserialize($this->getConfigValue(self::SYSTEM_CONFIG_KEY_SPECIFIC_FIELDS)) : [];

        $config = [];
        foreach ($systemValues as $value) {
            $id = array_shift($value);
            $config[$id] = $value;
        }
        return $config;
    }

    public function getSearchCriteria(): array
    {
        $systemValues = $this->getConfigValue(self::SYSTEM_CONFIG_KEY_SEARCH_CRITERIA) ?
            $this->json->unserialize($this->getConfigValue(self::SYSTEM_CONFIG_KEY_SEARCH_CRITERIA)) : [];

        $config = [];
        foreach ($systemValues as $value) {
            $id = array_shift($value);
            $config[$id] = $value;
        }
        return $config;
    }
}
