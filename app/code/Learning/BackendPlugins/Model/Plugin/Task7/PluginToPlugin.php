<?php

namespace Learning\BackendPlugins\Model\Plugin\Task7;

use Learning\BackendPlugins\Model\Plugin\Task7\TargetPlugin;

class PluginToPlugin
{
    public function beforeBeforeTargetForPlugin(TargetPlugin $subject)
    {
        echo 'I AM BEFORE!!! TARGET PLUGIN <======<br>';
    }
}
