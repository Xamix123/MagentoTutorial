<?php

namespace Learning\PageLayout\Block;

use Magento\Framework\View\Element\Template;

class TestBlock extends Template
{
    private $status = true;

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function showData()
    {
        if ($this->status) {
            echo 'It`s Enabled<br>';
        } else {
            echo 'It`s Disabled<br>';
        }
    }

    /**
     * @param $status
     */
    public function setEnabled($status)
    {
        $this->status = $status;
    }
}
