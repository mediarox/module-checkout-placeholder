<?php
/**
 * @package   Checkout_Placeholder
 * @copyright Copyright 2022 (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

declare(strict_types=1);

namespace Checkout\Placeholder\ViewModel;

use Checkout\Placeholder\Model\System\Config;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ConfigViewModel implements ArgumentInterface
{
    protected Config $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}
