<?php

namespace Learning\BackendPlugins\Model;

class OverrideOverrideBackendPlugins extends OverrideBackendPlugins
{
    public function someFunction()
    {
        echo "oh Crap i was overridden twice it`s unbelievable";
    }
}
