<?php

namespace Learning\UiFormTest\Model\ResourceModel;

use Learning\UiFormTest\Exception\FieldIsNotValidException;
use Learning\UiFormTest\Validator\EmailDataValidator;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class UiFormTest extends AbstractDb
{

    /**
     * @var EmailDataValidator
     */
    private $emailDataValidator;


    /**
     * UiFormTest constructor.
     * @param Context $context
     * @param EmailDataValidator $emailDataValidator
     * @param null $connectionName
     */
    public function __construct(
        Context $context,
        EmailDataValidator $emailDataValidator,
        $connectionName = null
    ) {
        $this->emailDataValidator = $emailDataValidator;
        parent::__construct($context, $connectionName);
    }

    protected function _construct()
    {
        $this->_init('ui_form_test', 'test_id');
    }

    /**
     * @throws FieldIsNotValidException
     */
    protected function _beforeSave(AbstractModel $object): UiFormTest
    {

        $this->emailDataValidator->validateData($object);

        return parent::_beforeSave($object);
    }
}
