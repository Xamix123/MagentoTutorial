<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\Task6\SharedTutorialModel;
use Learning\BackendTestVirtual\Model\ModelB;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class SharedTutorial extends Action
{
    private $sharedTutorial;
    private $modelB;

    /**
     * SharedTutorial constructor.
     * @param Context $context
     * @param SharedTutorialModel $sharedTutorial
     * @param ModelB $modelB
     */
    public function __construct(
        Context $context,
        SharedTutorialModel $sharedTutorial,
        ModelB $modelB
    ) {
        $this->sharedTutorial = $sharedTutorial;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->sharedTutorial->showCountObjects();
    }
}
