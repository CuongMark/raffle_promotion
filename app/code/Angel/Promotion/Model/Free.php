<?php


namespace Angel\Promotion\Model;

use Angel\Promotion\Api\Data\FreeInterface;
use Magento\Framework\Api\DataObjectHelper;
use Angel\Promotion\Api\Data\FreeInterfaceFactory;

class Free extends \Magento\Framework\Model\AbstractModel
{

    protected $freeDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'angel_promotion_free';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param FreeInterfaceFactory $freeDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Angel\Promotion\Model\ResourceModel\Free $resource
     * @param \Angel\Promotion\Model\ResourceModel\Free\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        FreeInterfaceFactory $freeDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Angel\Promotion\Model\ResourceModel\Free $resource,
        \Angel\Promotion\Model\ResourceModel\Free\Collection $resourceCollection,
        array $data = []
    ) {
        $this->freeDataFactory = $freeDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve free model with free data
     * @return FreeInterface
     */
    public function getDataModel()
    {
        $freeData = $this->getData();
        
        $freeDataObject = $this->freeDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $freeDataObject,
            $freeData,
            FreeInterface::class
        );
        
        return $freeDataObject;
    }
}
