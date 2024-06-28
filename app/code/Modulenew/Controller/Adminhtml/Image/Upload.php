<?php

namespace Vendor\Module\Controller\Adminhtml\Image;

use Magento\Backend\App\Action;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class Upload extends Action
{
    protected $uploaderFactory;
    protected $filesystem;

    public function __construct(
        Action\Context $context,
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $result = $uploader->save($mediaDirectory->getAbsolutePath('vendor_module/images'));

            $result['url'] = $this->_url->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . 'vendor_module/images' . $result['file'];
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
        } catch (\Exception $e) {
            return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData(['error' => $e->getMessage(), 'errorcode' => $e->getCode()]);
        }
    }
}
