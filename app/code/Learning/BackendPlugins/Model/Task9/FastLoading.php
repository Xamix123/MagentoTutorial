<?php

namespace Learning\BackendPlugins\Model\Task9;

class FastLoading
{
    protected $slowLoading;

    public function __construct(
        SlowLoading $slowLoading
    ) {
        $this->slowLoading = $slowLoading;
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
