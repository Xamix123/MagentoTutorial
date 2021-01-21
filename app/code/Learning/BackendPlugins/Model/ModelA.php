<?php

namespace Learning\BackendPlugins\Model;

use Learning\CarTutorial\Model\Car;

class ModelA
{
    protected $arg1;

    public function __construct(
        Car $arg1
    ) {
        $this->arg1 = $arg1;
    }


    public function someFunction()
    {
        var_export($this->arg1);
    }
}
