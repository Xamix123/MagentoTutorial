<?php

namespace Learning\BackendPlugins\Model\Plugin;

use Learning\BackendPlugins\Controller\Show\Page;

class AAAPlugin
{
    private $name = "AAAPlugin";

    public function beforeTargetForPlugin(Page $subject)
    {
        echo "i am plugin before target - $this->name<br> ";
    }

    public function aroundTargetForPlugin(Page $subject, callable $next)
    {
        echo "i am plugin around before target - $this->name<br> ";
        $next($this->name);
        echo "i am plugin around after target - $this->name <br>";
    }

    public function afterTargetForPlugin(Page $subject)
    {
        echo "i am plugin after target - $this->name <br>";
    }
}
