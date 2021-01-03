<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Grid;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;

class Grid extends Action
{
    // use DI to add resultRawFactory and layoutFactory

    /**
     * @var RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;

    /**
     * Grid constructor.
     * @param Context $context
     * @param RawFactory $rawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        LayoutFactory $layoutFactory
    ) {
        parent::__construct($context);
        $this->resultRawFactory = $rawFactory;
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * @return Raw
     */
    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create(); // create Raw Object
        $blogHtml = $this->layoutFactory->create()->createBlock(
            'Learning\AdminGrid\Block\Adminhtml\Grid\Grid',
            'grid.view.grid'
        )->toHtml(); //create Block with type Learning\AdminGrid\Block\Adminhtml\Grid\Grid and name grid.view.grid

        return $resultRaw->setContents($blogHtml); //set block to content raw
    }
}
