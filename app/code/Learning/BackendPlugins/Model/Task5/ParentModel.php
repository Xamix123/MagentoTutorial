<?php

namespace Learning\BackendPlugins\Model\Task5;

class ParentModel
{
    protected $name;
    protected $someIntVal;

    public function __construct($name, $someIntVal)
    {
        $this->name = $name;
        $this->someIntVal = $someIntVal;
    }

    public function ShowAttributes()
    {
        echo 'Name is : ' . $this->name . '<br>';
        echo 'SomeIntVal is : ' . $this->someIntVal . '<br>';
    }
}
