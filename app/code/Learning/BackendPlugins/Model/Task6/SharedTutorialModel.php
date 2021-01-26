<?php

namespace Learning\BackendPlugins\Model\Task6;

class SharedTutorialModel
{
    private static $countObjects = 0;

    public function __construct()
    {
        $this->increaseCountObjects();
    }

    public function increaseCountObjects()
    {
        self::$countObjects++;
    }

    public function showCountObjects()
    {
        echo 'Total Count objects = ' . self::$countObjects . '<br>';
    }
}
