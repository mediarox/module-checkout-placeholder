<?php
/**
 * @package   Mediarox_CheckoutPlaceholder
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\Model;

use Magento\Framework\Stdlib\ArrayManager;

class FieldFilter implements PlaceholderInterface
{
    protected ArrayManager $arrayManager;

    public function __construct(
        ArrayManager $arrayManager
    ) {
        $this->arrayManager = $arrayManager;
    }

    private function getFieldId(string $path)
    {
        $elements = explode(ArrayManager::DEFAULT_PATH_DELIMITER, $path);
        return array_pop($elements);
    }

    public function getLabeledFields(array $jsLayout): array
    {
        $checkoutRoot = $this->arrayManager->get(self::START_PATH_CHECKOUT_COMPONENTS_CHILDREN, $jsLayout);
        $componentPaths = $this->arrayManager->findPaths(
            self::KEY_LABEL,
            $checkoutRoot
        );

        $nodes = [];
        foreach ($componentPaths as $componentPath) {
            $componentPath = str_replace('/label', '', $componentPath);
            $node = $this->arrayManager->get($componentPath, $checkoutRoot);
            if ($node) {
                $node[self::KEY_ID] = $this->getFieldId($componentPath);
                $node[self::KEY_PATH] = self::START_PATH_CHECKOUT_COMPONENTS_CHILDREN .
                    ArrayManager::DEFAULT_PATH_DELIMITER .
                    $componentPath;
                $nodes[] = $node;
            }
        }
        return $nodes;
    }
}
