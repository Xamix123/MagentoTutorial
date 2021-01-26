<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\Task5\ChildModel;
use Learning\BackendPlugins\Model\Task5\ParentModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Inheritance extends Action
{
    private $parent;

    private $child;

    public function __construct(Context $context, ParentModel $parent, ChildModel $child)
    {
        $this->parent = $parent;
        $this->child = $child;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->parent->ShowAttributes();
        echo '<br>____________________________________<br>';
        $this->child->ShowAttributes();
    }
}
