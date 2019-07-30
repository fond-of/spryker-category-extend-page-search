<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander;

use FondOfSpryker\Zed\CategoryExtendPageSearch\Dependency\Plugin\CategoryPageMapExpanderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface;

/**
 * @method \FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\CategoryPageSearchCommunicationFactory getFactory()
 */
class CategoryIdPageMapExpanderPlugin extends AbstractPlugin implements CategoryPageMapExpanderInterface
{
    public const FK_CATEGORY = 'fk_category';

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
        $this->setCategoryId($pageMapTransfer, $pageMapBuilder, $categoryData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function setCategoryId(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        if (isset($cateoryData[self::FK_CATEGORY])) {
            $pageMapTransfer->setCategoryId($categoryData[self::FK_CATEGORY]);

            $this->setFullTextSearch($pageMapTransfer, $pageMapBuilder, $categoryData);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $categoryData
     *
     * @return void
     */
    protected function setFullTextSearch(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $categoryData): void
    {
        $pageMapBuilder->addFullText($pageMapTransfer, $categoryData[self::FK_CATEGORY]);
    }
}
