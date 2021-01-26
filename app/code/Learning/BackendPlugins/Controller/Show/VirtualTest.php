<?php

namespace Learning\BackendPlugins\Controller\Show;

use Learning\BackendPlugins\Model\Task4\RepositoryMethods;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class VirtualTest extends Action
{
    private $repositoryMethods;

    public function __construct(Context $context, RepositoryMethods $repositoryMethods)
    {
        $this->repositoryMethods = $repositoryMethods;
        parent::__construct($context);
    }

    public function execute()
    {
        $this->testFunction();
    }

    public function testFunction()
    {
        $this->repositoryMethods->createTable();
    }
}
