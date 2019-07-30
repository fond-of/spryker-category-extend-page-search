<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication;

use FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander\CategoryIdPageMapExpanderPlugin;
use FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander\CategoryKeyPageMapExpanderPlugin;
use Spryker\Zed\CategoryPageSearch\Communication\CategoryPageSearchCommunicationFactory as SprykerCategoryPageSearchCommunicationFactory;

class CategoryExtendPageSearchCommunicationFactory extends SprykerCategoryPageSearchCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\CategoryExtendPageSearch\Dependency\Plugin\CategoryPageMapExpanderInterface[];
     */
    public function getCategoryPageMapExpanderPlugins(): array
    {
        return [
            new CategoryIdPageMapExpanderPlugin(),
            new CategoryKeyPageMapExpanderPlugin(),
        ];
    }
}
