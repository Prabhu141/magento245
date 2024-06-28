<?php
namespace Vendor\Module\Controller\Adminhtml\Image;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Vendor\Module\Model\ImageFactory;

class Save extends Action
{
    protected $resultJsonFactory;
    protected $uploaderFactory;
    protected $imageFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        UploaderFactory $uploaderFactory,
        ImageFactory $imageFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->imageFactory = $imageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $path = $this->_objectManager->get('Magento\Framework\Filesystem')
                ->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
                ->getAbsolutePath('vendor_module/images/');
            
            $result = $uploader->save($path);
            $imagePath = 'vendor_module/images/' . $result['file'];

            $image = $this->imageFactory->create();
            $image->setData('image', $imagePath);
            $image->save();

            return $result->setData(['success' => true, 'image' => $imagePath]);
        } catch (\Exception $e) {
            return $result->setData(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
