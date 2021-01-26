<?php

namespace Learning\BackendTestVirtual\Model;

use Learning\BackendPlugins\Model\Task6\SharedTutorialModel;

class ModelB
{
    private $arg1;
    private $sharedTutorialModel;

    public function __construct(
        SharedTutorialModel $sharedTutorialModel
    ) {
        $this->sharedTutorialModel = $sharedTutorialModel;
    }
}
