<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander;

use FondOfSpryker\Zed\CategoryExtendPageSearch\Dependency\Plugin\CategoryPageMapExpanderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

/**
 * @method \FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\CategoryExtendPageSearchCommunicationFactory getFactory()
 */
class CategoryKeyPageMapExpanderPlugin extends AbstractPlugin implements CategoryPageMapExpanderInterface
{
    public const CATEGORY_KEY = 'category_key';
    public const SPY_CATEGORY = 'spy_category';

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandCategoryPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        $this->setCategoryKey($pageMapTransfer, $pageMapBuilder, $categoryData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function setCategoryKey(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        if (array_key_exists(self::SPY_CATEGORY, $categoryData)) {
            if (array_key_exists(self::CATEGORY_KEY, $categoryData[self::SPY_CATEGORY])) {
                $this->addSearchResultDataCategoryKey($pageMapTransfer, $pageMapBuilder, $categoryData);
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function addSearchResultDataCategoryKey(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        $pageMapBuilder->addSearchResultData($pageMapTransfer, self::CATEGORY_KEY, $categoryData[self::SPY_CATEGORY][self::CATEGORY_KEY]);
    }
}
