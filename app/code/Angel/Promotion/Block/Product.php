<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 5/1/2019
 * Time: 5:01 PM
 */

namespace Angel\Promotion\Block;

use Angel\Promotion\Model\FreeManagement;
use Magento\Catalog\Api\ProductRepositoryInterface;

class Product extends \Magento\Catalog\Block\Product\View
{
    private $freeManagement;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        FreeManagement $freeManagement,
        array $data = []
    ){
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->freeManagement = $freeManagement;
    }

    /**
     * @return \Angel\Promotion\Model\ResourceModel\Free\Collection
     */
    public function getRafflePromotion(){
        return $this->freeManagement->getPromotionByProductId($this->getProduct()->getId());
    }
}