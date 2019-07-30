<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch;

use Spryker\Zed\CategoryPageSearch\CategoryPageSearchDependencyProvider as SprykerCategoryPageSearchDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CategoryExtendPageSearchDependencyProvider extends SprykerCategoryPageSearchDependencyProvider
{
    public const PLUGIN_COLLECTION_CATEGORY_PAGE_MAP_EXPANDER = 'PLUGIN_COLLECTION_CATEGORY_PAGE_MAP_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        parent::provideCommunicationLayerDependencies($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    /*protected function addCategoryPageMapExpanderPlugins(Container $container): Container
    {
        $container[self::PLUGIN_COLLECTION_CATEGORY_PAGE_MAP_EXPANDER] = function (Container $container) {
            return $this->getCategoryPageMapExpanderPlugins();
        };

        return $container;
    }*/

    /**
     * @return array
     */
    /*protected function getCategoryPageMapExpanderPlugins(): array
    {
        return [];
    }*/
}
