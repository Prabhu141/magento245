<?php
namespace Magetop\Helloworld\Controller\Index;
 
use Magento\Framework\App\Action\Context;
use Magetop\Helloworld\Model\ResourceModel\Posts\CollectionFactory;
 
class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $_postsFactory;
 
    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        CollectionFactory $postsFactory)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_postsFactory = $postsFactory;
    }
 
    public function execute()
    {
        echo "Get Data From magetop_blog table";
        $this->_postsFactory->create();
        $collection = $this->_postsFactory->create()
            ->addFieldToSelect(array('title','description','created_at','status'))
            ->addFieldToFilter('status',1)
            ->setPageSize(10);
        echo '<pre>';
        print_r($collection->getData());
        echo '<pre>';
    }
}