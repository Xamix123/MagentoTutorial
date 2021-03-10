<?php

namespace Learning\AdminGrid\Controller\Adminhtml\Email;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Filesystem;

class Send extends Action
{
    protected $uploaderFactory;

    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->_fileFactory = $fileFactory;
        parent::__construct($context);
    }
    public function execute()
    {
        echo "Do Action Here ....";
        exit();
    }
}
