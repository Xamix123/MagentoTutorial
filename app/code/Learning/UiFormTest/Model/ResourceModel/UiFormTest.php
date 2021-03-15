<?php

namespace Learning\UiFormTest\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class UiFormTest extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('ui_form_test', 'test_id');
    }
}
