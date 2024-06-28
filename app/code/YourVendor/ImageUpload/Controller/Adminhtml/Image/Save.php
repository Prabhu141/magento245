<?php
namespace YourVendor\ImageUpload\Controller\Adminhtml\Image;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use YourVendor\ImageUpload\Model\ImageFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;
    protected $imageFactory;
    protected $uploaderFactory;
    protected $mediaDirectory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        ImageFactory $imageFactory,
        UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->imageFactory = $imageFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->mediaDirectory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            $model = $this->imageFactory->create();
            $id = $this->getRequest()->getParam('id');

            if ($id) {
                $model->load($id);
            }

            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {
                    $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);

                    $path = $this->mediaDirectory->getAbsolutePath('yourvendor/imageupload');
                    $result = $uploader->save($path);
                    $data['image'] = 'yourvendor/imageupload' . $result['file'];
                } catch (\Exception $e) {
                    $this->messageManager->addError($e->getMessage());
                }
            } else {
                if (isset($data['image']['value'])) {
                    $data['image'] = $data['image']['value'];
                } else {
                    $data['image'] = '';
                }
            }

            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('You saved the image.'));
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong while saving the image.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('YourVendor_ImageUpload::manage');
    }
}
