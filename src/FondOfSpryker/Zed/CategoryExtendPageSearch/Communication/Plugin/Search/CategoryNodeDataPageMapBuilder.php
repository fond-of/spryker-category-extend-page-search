<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\Search;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\CategoryPageSearch\Communication\Plugin\Search\CategoryNodeDataPageMapBuilder as SprykerCategoryNodeDataPageMapBuilder;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

/**
 * @method \FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\CategoryExtendPageSearchCommunicationFactory getFactory()
 * @method \Spryker\Zed\CategoryPageSearch\Business\CategoryPageSearchFacadeInterface getFacade()
 */
class CategoryNodeDataPageMapBuilder extends SprykerCategoryNodeDataPageMapBuilder
{
    /**
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function buildPageMap(PageMapBuilderInterface $pageMapBuilder, array $categoryData, LocaleTransfer $localeTransfer)
    {
        $pageMapTransfer = (new PageMapTransfer())
            ->setStore(Store::getInstance()->getStoreName())
            ->setLocale($localeTransfer->getLocaleName())
            ->setType(static::TYPE_CATEGORY)
            ->setIsActive($categoryData['spy_category']['is_active'] && $categoryData['spy_category']['is_searchable'])
            ->setCategoryId($categoryData['fk_category']);

        $categoryAttribute = $categoryData['spy_category']['spy_category_attributes'][0];

        $pageMapBuilder
            ->addSearchResultData($pageMapTransfer, 'id_category', $categoryData['fk_category'])
            ->addSearchResultData($pageMapTransfer, 'name', $categoryAttribute['name'])
            ->addSearchResultData($pageMapTransfer, 'url', $categoryData['spy_urls'][0]['url'])
            ->addSearchResultData($pageMapTransfer, 'type', static::TYPE_CATEGORY)
            ->addFullTextBoosted($pageMapTransfer, $categoryAttribute['name'])
            ->addFullText($pageMapTransfer, isset($categoryAttribute['meta_title']) ? $categoryAttribute['meta_title'] : '')
            ->addFullText($pageMapTransfer, isset($categoryAttribute['meta_keywords']) ? $categoryAttribute['meta_keywords'] : '')
            ->addFullText($pageMapTransfer, isset($categoryAttribute['meta_description']) ? $categoryAttribute['meta_description'] : '')
            ->addSuggestionTerms($pageMapTransfer, $categoryAttribute['name'])
            ->addCompletionTerms($pageMapTransfer, $categoryAttribute['name']);

        $this->expandCategoryPageMap($pageMapTransfer, $pageMapBuilder, $categoryData, $localeTransfer);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    protected function expandCategoryPageMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        foreach ($this->getFactory()->getCategoryPageMapExpanderPlugins() as $categoryPageMapExpanderPlugin) {
            $pageMapTransfer = $categoryPageMapExpanderPlugin->expandCategoryPageMap($pageMapTransfer, $pageMapBuilder, $categoryData, $localeTransfer);
        }

        return $pageMapTransfer;
    }
}
