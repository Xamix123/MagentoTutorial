<?php

namespace Learning\UiFormTest\Controller\Adminhtml\Form;

use Exception;
use Learning\UiFormTest\Model\ResourceModel\UiFormTest as ResourceModel;
use Learning\UiFormTest\Model\UiFormTestFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use RuntimeException;

class Save extends Action
{
    const XML_PATH_EMAIL_RECIPIENT = 'contact/email/recipient_email';

    //use Dependency Injection to add $resultPageFactory

    /** @var PageFactory */
    protected $resultPageFactory;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var Escaper
     */
    protected $_escaper;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var UiFormTestFactory
     */
    private $uiFormTestFactory;

    /**
     * @var ResourceModel
     */
    private $resourceModel;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param UiFormTestFactory $uiFormTestFactory
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        ScopeConfigInterface $scopeConfig,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        UiFormTestFactory $uiFormTestFactory,
        ResourceModel $resourceModel
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->inlineTranslation = $inlineTranslation;
        $this->_escaper = $escaper;
        $this->scopeConfig = $scopeConfig;
        $this->_transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->uiFormTestFactory = $uiFormTestFactory;
        $this->resourceModel = $resourceModel;
    }

    public function _constructor()
    {
        date_default_timezone_set('Europa/Kiev');
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     * @throws LocalizedException
     * @throws MailException
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();

        $data = array_merge($postObj['sample_fieldset'], ['created_at' => "2020-12-22 05:01:52"]);

        $this->inlineTranslation->suspend(); // stop inline translation

        if ($data) {
            $model = $this->uiFormTestFactory->create();
            $model->setData($data);

            if ((bool)$model->getStatus() == true) {
                $sender = [
                    'name' => 'It`s literally me',
                    'email' => $this->_escaper->escapeHtml($model->getEmail())
                ];

                $storeScope = ScopeInterface::SCOPE_STORE;
                $transport = $this->_transportBuilder
                    ->setTemplateIdentifier('send_email_email_template')
                    ->setTemplateOptions(
                        [
                            'area' => Area::AREA_FRONTEND,
                            'store' => Store::DEFAULT_STORE_ID,
                        ]
                    )
                    ->setTemplateVars([
                        'textData' => $model->getTextData(),
                    ])
                    ->setFrom($sender)
                    ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                    ->getTransport();

                $transport->sendMessage();
                $this->inlineTranslation->resume(); //recovery inline translation
                $this->messageManager->addSuccessMessage(__('Thanks for contacting us with your comments and questions.
                We\'ll respond to you very soon.'));
                $this->_redirect('*/*/main/');
                return;
            }
            try {
                $this->resourceModel->save($model);
            } catch (LocalizedException | RuntimeException $e) {
                $this->messageManager->addError($e->getMessage()); // if catch exception show message
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
                // if catch exception show message
            }
        }
    }
}
