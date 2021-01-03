<?php

namespace Learning\AdminGrid\Block\Adminhtml\Grid;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class Menu extends Container
{
    //this Block created menu in add and edit data pages

    /**
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * Menu constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'id'; // set object id
        $this->_blockGroup = 'learning_adminGrid'; // set block group
        $this->_controller = 'adminhtml_grid'; // set controller
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Grid')); // save button

        $this->buttonList->update('delete', 'label', __('Delete')); // delete button
    }

    /**
     * @return Phrase|string
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('learning_adminGrid_form_data')->getId()) {
            return __(
                "Menu Record '%1'",
                $this->escapeHtml($this->_coreRegistry->registry('learning_adminGrid_form_data')->getTitle()) //add title  for the title page edit
            );
        } else {
            return __('New Record'); // add New record for the title page edit
        }
    }

}
