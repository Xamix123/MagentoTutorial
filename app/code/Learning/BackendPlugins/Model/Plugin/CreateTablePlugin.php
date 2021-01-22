<?php

namespace Learning\BackendPlugins\Model\Plugin;

use Learning\BackendPlugins\Model\BackendPluginsInterface;

class CreateTablePlugin
{
    public function beforeGetList(BackendPluginsInterface $subject)
    {
        echo "<table border='1'>";
    }

    public function beforeShowItem(BackendPluginsInterface $subject)
    {
        echo "<tr>";
    }
    public function afterShowItem(BackendPluginsInterface $subject)
    {
        echo "</tr>";
    }

    public function afterGetList(BackendPluginsInterface $subject)
    {
        echo "</table>";
    }


}
