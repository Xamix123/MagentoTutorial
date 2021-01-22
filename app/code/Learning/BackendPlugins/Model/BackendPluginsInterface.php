<?php

namespace Learning\BackendPlugins\Model;

interface BackendPluginsInterface
{
    public function getList();
    public function showItem($item);
}
