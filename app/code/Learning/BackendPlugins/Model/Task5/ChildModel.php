<?php

namespace Learning\BackendPlugins\Model\Task5;

class ChildModel extends ParentModel
{
    protected $name;
    protected $someIntVal;

    public function __construct($name, $someIntVal)
    {
        parent::__construct($name, $someIntVal);
    }
}
