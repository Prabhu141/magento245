namespace Magetop\Helloworld\Controller\Adminhtml\Posts;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magetop\Helloworld\Controller\Adminhtml\Posts;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends Posts
{
    protected $uploaderFactory;

    public function __construct(
        Context $context,
        UploaderFactory $uploaderFactory
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->_objectManager->create('Magetop\Helloworld\Model\Posts');

        if (isset($data['id'])) {
            $model->load($data['id']);
        }

        // Handle the image upload
        try {
            if (isset($_FILES['image']) && $_FILES['image']['name']) {
                $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(false);

                $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')
                    ->getDirectoryRead(DirectoryList::MEDIA);
                $result = $uploader->save($mediaDirectory->getAbsolutePath('helloworld/images'));

                if ($result['file']) {
                    $data['image'] = '/helloworld/images/' . $result['file'];
                }
            } else {
                if (isset($data['image']['delete']) && $data['image']['delete'] == '1') {
                    $data['image'] = '';
                } else {
                    unset($data['image']);
                }
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Something went wrong while saving the image.'));
        }

        $model->setData($data);

        try {
            $model->save();
            $this->messageManager->addSuccess(__('The post has been saved.'));
            return $this->_redirect('*/*/');
        } catch (\Exception $e) {
            $this->messageManager->addError($e->getMessage());
        }

        return $this->_redirect('*/*/edit', ['id' => $model->getId()]);
    }
}
