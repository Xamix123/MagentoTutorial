<?php

namespace Learning\CarTutorial\Block;

use Magento\Framework\View\Element\Template;

class ParentBlock extends Template
{
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function showBlockName()
    {
        echo "i am ParentBLock";
    }
}
