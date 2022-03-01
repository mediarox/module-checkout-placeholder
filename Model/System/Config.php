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

    public function getConfigValue(string $key, string $basePath = self::SYSTEM_CONFIG_BASE_PATH_GENERAL)
    {
        return $this->scopeConfig->getValue(
            $basePath . $key,
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

    public function getEnableOptionalMark()
    {
        return (int)$this->getConfigValue(
            self::SYSTEM_CONFIG_KEY_ENABLE,
            self::SYSTEM_CONFIG_BASE_PATH_OPTIONAL_MARKS
        );
    }

    public function getOptionalMark(): string
    {
        $optionalMark = $this->getConfigValue(
            self::SYSTEM_CONFIG_KEY_CUSTOM_OPTIONAL_MARK,
            self::SYSTEM_CONFIG_BASE_PATH_OPTIONAL_MARKS
        ) ?: self::DEFAULT_OPTIONAL_MARK;

        return $this->getEnableOptionalMark() ? $optionalMark : '';
    }

    public function getFieldConfig(string $fieldId, string $path): array
    {
        if (0 < (int)$fieldId) {
            $fieldId = self::COLUMN_KEY_STREET_PREFIX . $fieldId;
        }

        $configPaths = [
            self::SYSTEM_CONFIG_BASE_PATH_GENERAL => self::SYSTEM_CONFIG_KEY_SPECIFIC_FIELDS,
            self::SYSTEM_CONFIG_BASE_PATH_OPTIONAL_MARKS => self::SYSTEM_CONFIG_KEY_OPTIONAL_FIELDS
        ];

        $config = [];
        foreach ($configPaths as $basePath => $configKey) {
            $systemValues = $this->getConfigValue($configKey, $basePath) ?
                $this->json->unserialize($this->getConfigValue($configKey, $basePath)) : [];

            foreach ($systemValues as $value) {
                if (array_shift($value) === $fieldId) {
                    $isUnique = isset($value[self::COLUMN_KEY_FIELDSET_ID]) && !empty($value[self::COLUMN_KEY_FIELDSET_ID]);
                    $correctPath = $isUnique ? strstr($path, $value[self::COLUMN_KEY_FIELDSET_ID]) : false;
                    if ($isUnique && $correctPath) {
                        $config = array_merge($config, $value);
                    } elseif ($isUnique && !$correctPath) {
                        continue;
                    } else {
                        $config = array_merge($config, $value);
                    }
                    if ($basePath == self::SYSTEM_CONFIG_BASE_PATH_OPTIONAL_MARKS) {
                        $config[self::SYSTEM_CONFIG_KEY_CUSTOM_OPTIONAL_MARK] = $this->getOptionalMark();
                    }
                }
            }
        }
        return $config;
    }
}
