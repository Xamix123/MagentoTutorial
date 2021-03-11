<?php

namespace Learning\PageLayout\Block;

use Magento\Framework\View\Element\Template;

class TestBlock extends Template
{
    private $status = true;

    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function showData()
    {
        return $this->status
            ? 'It`s Enabled<br>'
            : 'It`s Disabled<br>';
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
