<?php

namespace Learning\BackendPlugins\Model\Plugin\Task4;

use Learning\BackendPlugins\Model\Interfaces\Task4\BackendPluginsInterface;

class CreateTablePlugin
{
    public function beforeGetList(BackendPluginsInterface $subject)
    {
        echo '<table cellpadding="7" border="1">';
    }

    public function afterGetList(BackendPluginsInterface $subject)
    {
        echo '</table>';
    }

    public function beforeShowItem(BackendPluginsInterface $subject)
    {
        echo '<tr>';
    }

    public function afterShowItem(BackendPluginsInterface $subject)
    {
        echo '</tr>';
    }
}
