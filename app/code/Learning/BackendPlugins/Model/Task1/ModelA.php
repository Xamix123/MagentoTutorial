<?php

namespace Learning\BackendPlugins\Model\Task1;

class ModelA
{
    protected $arg1;
    protected $arg2;
    protected $arg3;

    public function __construct(
        $arg1,
        $arg2,
        $arg3
    ) {
        $this->arg1 = $arg1;
        $this->arg2 = $arg2;
        $this->arg3 = $arg3;
    }

    public function someFunction()
    {
        echo 'first arg = ' . $this->arg1 . ' type is -> ' . gettype($this->arg1) . '  <br>';
        echo 'second arg = ' . $this->arg2 . ' type is -> ' . gettype($this->arg2) . '  <br>';
        echo 'third arg = ' . $this->arg3 . ' type is -> ' . gettype($this->arg3) . '  <br>';
    }
}
