<?php

namespace Learning\BackendPlugins\Model\Plugin\Task8;

use Learning\BackendPlugins\Controller\Show\PluginParameter;

class TargetPluginParameter
{
    public function beforeTargetForParameterPlugin(PluginParameter $subject, $name): string
    {

        $name = 'i am parameter $name and i was overridden by before plugin';


        return '(' . $name . ')';
    }

//    public function aroundTargetForParameterPlugin(PluginParameter $subject, callable $func, $name)
//    {
//        $name = 'Around Before +' . $name;
//        $func($name);
//        $name = $name . '+ Around After<br>';
//        return $name;
//    }


    public function afterTargetForParameterPlugin(PluginParameter $subject, $result): string
    {
        return 'After Plugin Override 123456789 ' . $result . ' 987654321';
    }


}
