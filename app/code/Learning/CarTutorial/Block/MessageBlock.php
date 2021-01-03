<?php

namespace Learning\CarTutorial\Block;

use Magento\Framework\Message\CollectionFactory;
use Magento\Framework\Message\Factory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\View\Element\Message;
use Magento\Framework\View\Element\Messages;
use Magento\Framework\View\Element\Template;

class MessageBlock extends Messages
{
    public function __construct(
        Template\Context $context,
        Factory $messageFactory,
        CollectionFactory $collectionFactory,
        ManagerInterface $messageManager,
        Message\InterpretationStrategyInterface $interpretationStrategy,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $messageFactory,
            $collectionFactory,
            $messageManager,
            $interpretationStrategy,
            $data
        );
    }

    protected function _prepareLayout()
    {
        $this->addMessages($this->messageManager->getMessages(true));
        return parent::_prepareLayout();
    }
}
