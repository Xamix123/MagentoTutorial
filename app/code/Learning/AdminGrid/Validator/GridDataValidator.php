<?php

namespace Learning\AdminGrid\Validator;

use Learning\AdminGrid\Exception\FieldIsNotValidException;
use Learning\AdminGrid\Model\AdminGrid;

class GridDataValidator
{
    /**
     * @param string $name
     * @return false|int
     */
    private function validateName(string $name)
    {
        return preg_match('/^[A-Za-zА-ЯЁа-яё]{6,30}$/', $name);
    }

    /**
     * @param string $email
     * @return mixed
     */
    private function validateEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param string $value
     * @param int $min
     * @param int $max
     * @return bool
     */
    private function validateLength(string $value, int $min, int $max) : bool
    {
        $length = strlen($value);
        return ($length < $min || $length > $max) ? false : true;
    }

    /**
     * @param string $status
     * @return bool
     */
    private function validateStatus(string $status) : bool
    {
        return array_key_exists($status,AdminGrid::STATUSES_ARRAY);
    }

    /**
     * @param $object
     * @return bool
     * @throws FieldIsNotValidException
     */
    public function validateData($object): bool
    {
        $data = $object->getData();

        if (! $this->validateName($data['name'])) {
            throw new FieldIsNotValidException('name', 'Field name must contains only letters and
            his length must be between 6 and 30 characters.');
        }

        if (! $this->validateEmail($data['email'])) {
            throw new FieldIsNotValidException('email', 'Wrong format of email');
        }

        if (! $this->validateLength($data['title'], 15, 100)) {
            throw new FieldIsNotValidException('title', 'Wrong number of characters field length must be
            between 15 and 100 characters.');
        }

        if (! $this->validateLength($data['description'], 15, 300)) {
            throw new FieldIsNotValidException('description', 'Wrong number of characters field length must be
            between 15 and 300 characters.');
        }

        if (! $this->validateStatus($data['status'])) {
            throw new FieldIsNotValidException('status', 'Wrong format of status.');
        }

        return true;
    }
}
