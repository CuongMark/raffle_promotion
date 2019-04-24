<?php


namespace Angel\Promotion\Model;

use Magento\Framework\Api\DataObjectHelper;
use Angel\Promotion\Api\Data\PromotionInterfaceFactory;
use Angel\Promotion\Api\Data\PromotionInterface;

class Promotion extends \Magento\Framework\Model\AbstractModel
{

    protected $promotionDataFactory;

    protected $_eventPrefix = 'angel_promotion_promotion';
    protected $dataObjectHelper;


    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param PromotionInterfaceFactory $promotionDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Angel\Promotion\Model\ResourceModel\Promotion $resource
     * @param \Angel\Promotion\Model\ResourceModel\Promotion\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        PromotionInterfaceFactory $promotionDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Angel\Promotion\Model\ResourceModel\Promotion $resource,
        \Angel\Promotion\Model\ResourceModel\Promotion\Collection $resourceCollection,
        array $data = []
    ) {
        $this->promotionDataFactory = $promotionDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve promotion model with promotion data
     * @return PromotionInterface
     */
    public function getDataModel()
    {
        $promotionData = $this->getData();
        
        $promotionDataObject = $this->promotionDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $promotionDataObject,
            $promotionData,
            PromotionInterface::class
        );
        
        return $promotionDataObject;
    }
}
