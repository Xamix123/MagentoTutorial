<?php

namespace Learning\ClothingMaterial\Block;

use Learning\ClothingMaterial\Model\Attribute\Source\CmsBlock;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Block\Product\View;
use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductTypes\ConfigInterface;
use Magento\Cms\Api\BlockRepositoryInterface;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Json\EncoderInterface;
use Magento\Framework\Locale\FormatInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Stdlib\StringUtils;

class CustomProductView extends View
{
    private $cmsBlockRepository;

    public function __construct(
        Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        EncoderInterface $jsonEncoder,
        StringUtils $string,
        Product $productHelper,
        ConfigInterface $productTypeConfig,
        FormatInterface $localeFormat,
        Session $customerSession,
        ProductRepositoryInterface $productRepository,
        BlockRepositoryInterface $cmsBlockRepository,
        PriceCurrencyInterface $priceCurrency,
        array $data = []
    ) {
        $this->cmsBlockRepository = $cmsBlockRepository;

        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
    }

    /**
     * @return BlockInterface
     * @throws LocalizedException
     */
    public function getCmsBlock()
    {
        $cmsBlockId = $this->getProduct()->getData(CmsBlock::CMS_BLOCK_ATTRIBUTE);

        return $this->cmsBlockRepository->getById($cmsBlockId);
    }
}
