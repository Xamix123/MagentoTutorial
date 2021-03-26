<?php

namespace Learning\UiFormTest\Validator;

use Learning\UiFormTest\Exception\FieldIsNotValidException;
use Learning\UiFormTest\Model\UiFormTest;
use Magento\Framework\DataObject;

class EmailDataValidator
{
    /**
     * @param string $email
     * @return bool
     */
    private function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $status
     * @return bool
     */
    private function validateStatus(string $status) : bool
    {
        return array_key_exists($status, UiFormTest::STATUSES);
    }

    /**
     * @param DataObject $object
     * @return bool
     * @throws FieldIsNotValidException
     */
    public function validateData(DataObject $object): bool
    {
        $data = $object->getData();

        if (! $this->validateEmail($data['email'])) {
            throw new FieldIsNotValidException('email', 'Wrong format of email');
        }

        if (! $this->validateStatus($data['status'])) {
            throw new FieldIsNotValidException('status', 'Wrong format of status.');
        }

        return true;
    }
}
