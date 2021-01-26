<?php

namespace Learning\BackendPlugins\Model\Task1;

use Learning\BackendPlugins\Model\Interfaces\Task1\SomeTestInterface;

class OverrideBackendPlugins implements SomeTestInterface
{
    public function someFunction()
    {
        echo "oh Crap i was overridden";
    }
}
