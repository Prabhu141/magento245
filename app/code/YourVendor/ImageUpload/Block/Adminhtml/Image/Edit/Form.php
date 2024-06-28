<?php
namespace YourVendor\ImageUpload\Block\Adminhtml\Image\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getUrl('*/*/save'), 'method' => 'post', 'enctype' => 'multipart/form-data']]
        );

        $form->setHtmlIdPrefix('image_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Image Information')]);

        if ($this->_coreRegistry->registry('imageupload_image')->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true,
            ]
        );

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required' => true,
            ]
        );

        $form->setValues($this->_coreRegistry->registry('imageupload_image')->getData());
        $form->setUseContainer(true);  // Ensure the form key is included
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
