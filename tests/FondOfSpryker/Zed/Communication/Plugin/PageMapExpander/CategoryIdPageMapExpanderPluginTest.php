<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilder;

class CategoryIdPageMapExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\PageMapTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pageMapTransferMock;

    /**
     * @var \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilder|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pageMapBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods(['setCategoryId'])
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['addFullText'])
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExpandCategoryPageMapWithCategoryIdTrue(): void
    {
        $this->pageMapTransferMock->expects($this->atLeastOnce())
            ->method('setCategoryId');

        $this->pageMapBuilderMock->expects($this->atLeastOnce())
           ->method('addFullText');

        $categoryIdPageMapExpanderPlugin = new CategoryIdPageMapExpanderPlugin();

        $categoryIdPageMapExpanderPlugin->expandCategoryPageMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            ['fk_category' => 999],
            $this->localeTransferMock
        );
    }

    /**
     * @return void
     */
    public function testExpandCategoryPageMapWithCategoryIdFalse(): void
    {
        $this->pageMapTransferMock->expects($this->never())
            ->method('setCategoryId');

        $this->pageMapBuilderMock->expects($this->never())
            ->method('addFullText');

        $categoryIdPageMapExpanderPlugin = new CategoryIdPageMapExpanderPlugin();

        $categoryIdPageMapExpanderPlugin->expandCategoryPageMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            ['foo' => 999],
            $this->localeTransferMock
        );
    }
}
