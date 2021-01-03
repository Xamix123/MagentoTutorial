<?php

namespace Learning\CarTutorial\Block;

use Magento\Framework\View\Element\Template;

class Block1 extends Template
{
    public $name = "Block1";

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function showBlockName()
    {
        return isset($this->name) ? $this->name : "undefined name block";
    }
}
