<?php
namespace Mynewvendor\Mytheme\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Framework\UrlInterface;

class SampleProduct extends Template
{
    protected $productCollectionFactory;
    protected $listProductBlock;
    protected $urlBuilder;

    public function __construct(
        Template\Context $context,
        CollectionFactory $productCollectionFactory,
        ListProduct $listProductBlock,
        UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->listProductBlock = $listProductBlock;
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    public function getProductCollection()
    {
        $collection = $this->productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->setPageSize(6); // Limit to 6 products, change as needed
        return $collection;
    }

    public function getListProductBlock()
    {
        return $this->listProductBlock;
    }

    public function getReviewsSummaryHtml($product)
    {
        return $this->listProductBlock->getReviewsSummaryHtml($product, 'short');
    }

    public function getAddToCartUrl($product)
    {
        return $this->urlBuilder->getUrl('checkout/cart/add', ['product' => $product->getId()]);
    }
}
