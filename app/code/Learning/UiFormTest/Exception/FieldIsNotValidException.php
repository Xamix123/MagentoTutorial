<?php

namespace Learning\UiFormTest\Exception;

use Exception;
use Throwable;

class FieldIsNotValidException extends Exception
{
    private $field;

    public function __construct(
        $field = "",
        $description = "",
        $code = 0,
        Throwable $previous = null
    ) {
        $this->field = $field;
        $message = 'Field ' . $this->field . ' is not valid.' . $description . " ";
        parent::__construct($message, $code, $previous);
    }
}
