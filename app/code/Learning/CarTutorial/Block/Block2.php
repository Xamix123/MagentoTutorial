<?php

namespace Learning\CarTutorial\Block;

use Learning\CarTutorial\ViewModel\Car;
use Magento\Framework\View\Element\Text;
use Magento\Framework\View\Element\Template;

class Block2 extends Text
{
    private $name = "Some Name 123";
    private $car;

    public function __construct(
        Template\Context $context,
        Car $car,
        array $data = []
    ) {
        $this->car = $car;
        parent::__construct($context, $data);
    }

    public function showBlockName()
    {
        return isset($this->name) ? $this->name : "undefined name block";
    }

    /**
     * @return string
     */
    public function Hello()
    {
        return "Hello i am " . $this->showBlockName();
    }

    public function _toHtml()
    {
        $collection = $this->car->getItems();

        $html ='<div name="collection"> <ul>';

        foreach ($collection as $id => $value) {
            $html  .= '<li>' . $value->toString() . '</li>';
        }
        $html .='</ul> </div>';

        return $html;
    }
}
