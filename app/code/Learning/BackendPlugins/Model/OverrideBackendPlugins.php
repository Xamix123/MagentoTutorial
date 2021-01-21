<?php

namespace Learning\BackendPlugins\Model;

class OverrideBackendPlugins implements BackendPluginsInterface
{
    public function someFunction()
    {
        echo "oh Crap i was overridden";
    }
}
