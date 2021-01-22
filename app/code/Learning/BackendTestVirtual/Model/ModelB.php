<?php

namespace Learning\BackendTestVirtual\Model;

use Learning\BackendPlugins\Model\ModelA;

class ModelB
{
    private $arg1;

    public function __construct(ModelA $arg1)
    {
        $this->arg1 = $arg1;
    }

    public function test()
    {
        $this->arg1->someFunction();
    }
}
