<?php

namespace Learning\BackendPlugins\Model\Task1;

class OverrideOverrideBackendPlugins extends OverrideBackendPlugins
{
    public function someFunction()
    {
        echo "oh Crap i was overridden twice it`s unbelievable";
    }
}
