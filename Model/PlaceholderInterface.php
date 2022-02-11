<?php
/**
 * @package   ${package}
 * @copyright Copyright ${copy_year} (c) mediarox UG (haftungsbeschraenkt) (http://www.mediarox.de)
 * @author    Marcus Bernt <mbernt@mediarox.de>
 */

namespace Checkout\Placeholder\Model;

interface PlaceholderInterface
{
    public const KEY_STREET = 'street';
    const NEEDLE = '_';
    public const COMPONENT_SEARCH_KEY = 'searchKey';
    public const COMPONENT_SEARCH_PATH = 'path';
}
