<?php

namespace Learning\BackendPlugins\Model\Plugin\Task2;

use Learning\BackendPlugins\Controller\Show\Plugin;

class AAAPlugin
{
    private $name = "AAAPlugin";

    public function beforeTargetForPlugin(Plugin $subject)
    {
        echo "i am plugin before target - $this->name<br> ";
    }

    public function aroundTargetForPlugin(Plugin $subject, callable $next)
    {
        echo "i am plugin around before target - $this->name<br> ";
        $next($this->name);
        echo "i am plugin around after target - $this->name <br>";
    }

    public function afterTargetForPlugin(Plugin $subject)
    {
        echo "i am plugin after target - $this->name <br>";
    }
}
