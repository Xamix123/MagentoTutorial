<?php

namespace Learning\BackendPlugins\Model\Interfaces;

interface BackendPluginsInterface
{
    public function getList($object);
    public function showItem($item);
}
