<?php

namespace Learning\AdminGrid\Block\Adminhtml\Grid\Edit;

use Learning\AdminGrid\Model\AdminGrid;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class Form extends Generic
{
    //this block create Form with the specified method, id

    /**
     * Form constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Form
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
            'data' => [
                'id' => 'edit_form',
                'action' => $this->getData('action'),
                'method' => 'post', // method for form
                'enctype' => 'multipart/form-data',
            ],
          ]
        );
        $form->setUseContainer(true); //TODO CHECK THIS FIELD

        $model = $this->_coreRegistry->registry('learning_adminGrid_form_data');
        $isElementDisabled = false;
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('AdminGridInfo')]);
        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
            $isElementDisabled = (bool)$model->getStatus();
        }

        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name', // name input box
                'label' => __('Name'), // label input box name
                'title' => __('Title'),
                'placeholder' => __('Enter your name'),
                'required' => true, // required filed cannot be NULL
                'disabled' => $isElementDisabled // element can be disabled by flag $isElementDisabled
            ]
        );

        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
                'placeholder' => __('Enter email'),
                'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title', // name input box
                'label' => __('Title'), // label input box
                'title' => __('Title'),
                'placeholder' => __('Enter title'), // placeholder to field title
                'required' => true, // required filed cannot be NULL
                'disabled' => $isElementDisabled // element can be disabled by flag $isElementDisabled
            ]
        );

        $fieldset->addField(
            'description',
            'textarea',
            [
                'name' => 'description',
                'label' => __('Description'),
                'title' => __('Description'),
                'placeholder' => __('Enter description'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'status',
                'required' => true,
                'options' => AdminGrid::STATUSES_ARRAY,
                'disabled' => false,
            ]
        );

        if (!$model->getId()) {
            $model->setData('status', $isElementDisabled ? '0' : '1');
        }

        $form->addValues($model->getData());

        $this->setForm($form);
        return parent::_prepareForm();
    }
}
