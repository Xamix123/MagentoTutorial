<?php

namespace Learning\BackendPlugins\Model\Plugin\Task7;

use Learning\BackendPlugins\Controller\Show\Plugin;

class TargetPlugin
{
    public function beforeTargetForPlugin(Plugin $subject)
    {
        echo 'I AM TARGET PLUGIN <====== <br>';
    }
}
