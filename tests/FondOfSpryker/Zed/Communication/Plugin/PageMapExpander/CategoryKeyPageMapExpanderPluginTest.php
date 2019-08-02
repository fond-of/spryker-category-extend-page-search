<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\PageMapExpander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilder;

class CategoryKeyPageMapExpanderPluginTest extends Unit
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
    public function _before()
    {
        $this->pageMapTransferMock = $this->getMockBuilder(PageMapTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods(['setCategoryKey'])
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods(['addSearchResultData'])
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExpandCategoryPageMapWithCategoryKeyTrue(): void
    {
        $this->pageMapTransferMock->expects($this->atLeastOnce())
            ->method('setCategoryKey');

        $this->pageMapBuilderMock->expects($this->atLeastOnce())
            ->method('addSearchResultData');

        $categoryKeyPageMapExpanderPlugin = new CategoryKeyPageMapExpanderPlugin();
        $categoryKeyPageMapExpanderPlugin->expandCategoryPageMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            ['spy_category' => ['category_key' => 'CategoryKey']],
            $this->localeTransferMock
        );
    }

    /**
     * @return void
     */
    public function testExpandCategoryPageMapWithCategoryKeyFalse(): void
    {
        $this->pageMapTransferMock->expects($this->never())
            ->method('setCategoryKey');

        $this->pageMapBuilderMock->expects($this->never())
            ->method('addSearchResultData');

        $categoryKeyPageMapExpanderPlugin = new CategoryKeyPageMapExpanderPlugin();
        $categoryKeyPageMapExpanderPlugin->expandCategoryPageMap(
            $this->pageMapTransferMock,
            $this->pageMapBuilderMock,
            ['foo' => ['bar' => 'CategoryKey']],
            $this->localeTransferMock
        );
    }
}
