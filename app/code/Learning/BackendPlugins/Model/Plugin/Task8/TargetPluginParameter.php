<?php

namespace Learning\BackendPlugins\Model\Plugin\Task8;

use Learning\BackendPlugins\Controller\Show\Plugin;

class TargetPluginParameter
{
    public function beforeTargetForPlugin(Plugin $subject, $name)
    {
        return ['(' . $name . ')'];
    }
}
