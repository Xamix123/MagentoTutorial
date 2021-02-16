<?php

namespace Learning\BackendPlugins\Model\Task9;

use Learning\BackendPlugins\Model\Task9\SlowLoading\Proxy;

class FastLoading
{

    protected $slowLoading;

    public function __construct(
        Proxy $slowLoading
    ) {
        $this->slowLoading = $slowLoading;
        var_dump($slowLoading);
    }

    /**
     * @return string
     */
    public function getFastValue(): string
    {
        return 'FastLoading value';
    }

    /**
     * @return string
     */
    public function getSlowValue(): string
    {
        return $this->slowLoading->getValue();
    }
}
