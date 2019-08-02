<?php

namespace FondOfSpryker\Zed\CategoryExtendPageSearch\Communication\Plugin\Search;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilder;

class CategoryNodeDataPageMapBuilderTest extends Unit
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
            ->setMethods([
                'setStore',
                'setLocale',
                'setType',
                'setIsActive',
                'setCategoryId',
            ])
            ->getMock();

        $this->pageMapBuilderMock = $this->getMockBuilder(PageMapBuilder::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'addSearchResultData',
                'addFullTextBoosted',
                'addFullText',
                'addSuggestionTerms',
                'addCompletionTerms',
            ])
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->getMock();
    }

    /**
     * @return void
     */
    public function testBuildPageMapSuccess(): void
    {
        $categoryData = [
            'fk_category' => 1,
            'name' => 'Name',
            'url' => 'my/url',
            'type' => 'category',
            'spy_category' => [
                'spy_category_attributes' => [
                    [
                        'is_active' => true,
                        'name' => 'Name',
                        'meta_title' => 'MetaTitle',
                        'meta_keywords' => 'MetaKeywords',
                        'meta_description' => 'MetaDescription',
                    ],
                ],
            ],
        ];

        $categoryNodeDataPageMapBuilder = new CategoryNodeDataPageMapBuilder();
        $categoryNodeDataPageMapBuilder->buildPageMap(
            $this->pageMapBuilderMock,
            $categoryData,
            $this->localeTransferMock
        );
    }
}
