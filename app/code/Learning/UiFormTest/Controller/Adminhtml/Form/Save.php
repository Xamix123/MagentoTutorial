<?php

namespace Learning\UiFormTest\Controller\Adminhtml\Form;

use Exception;
use Learning\UiFormTest\Exception\FieldIsNotValidException;
use Learning\UiFormTest\Model\ResourceModel\UiFormTest as ResourceModel;
use Learning\UiFormTest\Model\UiFormTest;
use Learning\UiFormTest\Model\UiFormTestFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Stdlib\DateTime\DateTime;
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
     * @var DateTime
     */
    private $date;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param StateInterface $inlineTranslation
     * @param Escaper $escaper
     * @param ScopeConfigInterface $scopeConfig
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param UiFormTestFactory $uiFormTestFactory
     * @param ResourceModel $resourceModel
     * @param DateTime $date
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
        ResourceModel $resourceModel,
        DateTime $date
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
        $this->date = $date;
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();

        $date = $this->date->gmtDate();
        $data = array_merge($postObj['sample_fieldset'], ['created_at' => $date]);

        $this->inlineTranslation->suspend(); // stop inline translation

        try {
            if ($data) {
                $model = $this->uiFormTestFactory->create();
                $model->setData($data);

                $this->resourceModel->save($model);

                if (UiFormTest::STATUSES[$model->getStatus()] === true) {
                    $sender = [
                            'name' => $this->_escaper->escapeHtml($model->getEmail()),
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
                                'textData' => $model->getTextData() === null
                                    ? "Default text message"
                                    : $model->getTextData(),
                                'email' => $model->getEmail() === null
                                    ? "Default mail"
                                    : $model->getEmail(),
                                'created_at' => $model->getCreatedAt() === null
                                    ? "Undefined time"
                                    : $model->getCreatedAt()
                            ])
                            ->setFromByScope($sender)
                            ->addTo($this->scopeConfig->getValue(self::XML_PATH_EMAIL_RECIPIENT, $storeScope))
                            ->getTransport();

                    $transport->sendMessage();
                    $this->inlineTranslation->resume(); //recovery inline translation
                }

                $this->messageManager->addSuccessMessage(__('Thanks for contacting us with your comments and questions.
                        We\'ll respond to you very soon.'));
                $this->_redirect('*/*/main/');
                return;
            }
        } catch (FieldIsNotValidException | LocalizedException | RuntimeException $e) {
            $this->messageManager->addExceptionMessage($e); // if catch exception show message
        } catch (Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the data.'));
            // if catch exception show message
        }
        $this->_redirect('*/*/main/');
        return;
    }
}
