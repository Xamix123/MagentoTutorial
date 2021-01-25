<?php

namespace Learning\BackendPlugins\Model;

use Learning\BackendPlugins\Model\Interfaces\SomeTestInterface;

class OverrideBackendPlugins implements SomeTestInterface
{
    public function someFunction()
    {
        echo "oh Crap i was overridden";
    }
}
