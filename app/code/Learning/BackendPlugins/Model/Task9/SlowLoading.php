<?php

namespace Learning\BackendPlugins\Model\Task9;

class SlowLoading
{
    public function __construct()
    {
        var_export("i am here");
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return 'SlowLoading value';
    }
}
