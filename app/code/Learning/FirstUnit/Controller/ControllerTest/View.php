<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Learning\FirstUnit\Controller\ControllerTest;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class View extends Action
{
//    /**
//     * @var JsonFactory
//     */
//    protected $resultJsonFactory;
//    /**
//     * @param Context $context
//     * @param JsonFactory $resultJsonFactory
//     */
//    public function __construct(
//        Context $context,
//        JsonFactory $resultJsonFactory)
//    {
//        $this->resultJsonFactory = $resultJsonFactory;
//        parent::__construct($context);
//    }
//    /**
//     * View  page action
//     *
//     * @return ResultInterface
//     */
//    public function execute()
//    {
//        $result = $this->resultJsonFactory->create();
//        $data = ['message' => 'Car world!'];
//
//        return $result->setData($data);
//    }

    public function execute()
    {
        echo "Car world";
    }
}
