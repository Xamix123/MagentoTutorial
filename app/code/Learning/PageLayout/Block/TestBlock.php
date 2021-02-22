<?php

namespace Learning\PageLayout\Block;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;

class TestBlock extends Template
{
    private $status = true;

    protected $_escaper;

    public function __construct(
        Template\Context $context,
        Escaper $_escaper,
        array $data = []
    ) {
        $this->_escaper = $_escaper;
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

    /**
     * @return string
     */
    public function getBreakpoints(): string
    {
        return \GuzzleHttp\json_encode($this->getVar('breakpoints'));
    }

}
