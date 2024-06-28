<?php
namespace YourVendor\ImageUpload\Block\Adminhtml\Image;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_image';
        $this->_blockGroup = 'YourVendor_ImageUpload';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Image'));
        $this->buttonList->update('delete', 'label', __('Delete Image'));

        $this->buttonList->add(
            'save_and_continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form']],
                ],
            ],
            -100
        );

        $this->_formScripts[] = "
            function saveAndContinueEdit() {
                editForm.submit($('edit_form').action + 'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('imageupload_image')->getId()) {
            return __("Edit Image '%1'", $this->escapeHtml($this->_coreRegistry->registry('imageupload_image')->getTitle()));
        } else {
            return __('New Image');
        }
    }
}
