<?php


namespace Angel\Promotion\Model;

use Magento\Framework\Reflection\DataObjectProcessor;
use Angel\Promotion\Api\PromotionRepositoryInterface;
use Angel\Promotion\Model\ResourceModel\Promotion as ResourcePromotion;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Angel\Promotion\Api\Data\PromotionInterfaceFactory;
use Angel\Promotion\Api\Data\PromotionSearchResultsInterfaceFactory;
use Angel\Promotion\Model\ResourceModel\Promotion\CollectionFactory as PromotionCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class PromotionRepository implements PromotionRepositoryInterface
{

    protected $dataPromotionFactory;

    protected $dataObjectHelper;

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $promotionFactory;

    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    protected $promotionCollectionFactory;


    /**
     * @param ResourcePromotion $resource
     * @param PromotionFactory $promotionFactory
     * @param PromotionInterfaceFactory $dataPromotionFactory
     * @param PromotionCollectionFactory $promotionCollectionFactory
     * @param PromotionSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourcePromotion $resource,
        PromotionFactory $promotionFactory,
        PromotionInterfaceFactory $dataPromotionFactory,
        PromotionCollectionFactory $promotionCollectionFactory,
        PromotionSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->promotionFactory = $promotionFactory;
        $this->promotionCollectionFactory = $promotionCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPromotionFactory = $dataPromotionFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Angel\Promotion\Api\Data\PromotionInterface $promotion
    ) {
        /* if (empty($promotion->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $promotion->setStoreId($storeId);
        } */
        
        $promotionData = $this->extensibleDataObjectConverter->toNestedArray(
            $promotion,
            [],
            \Angel\Promotion\Api\Data\PromotionInterface::class
        );
        
        $promotionModel = $this->promotionFactory->create()->setData($promotionData);
        
        try {
            $this->resource->save($promotionModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the promotion: %1',
                $exception->getMessage()
            ));
        }
        return $promotionModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($promotionId)
    {
        $promotion = $this->promotionFactory->create();
        $this->resource->load($promotion, $promotionId);
        if (!$promotion->getId()) {
            throw new NoSuchEntityException(__('promotion with id "%1" does not exist.', $promotionId));
        }
        return $promotion->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->promotionCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Angel\Promotion\Api\Data\PromotionInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Angel\Promotion\Api\Data\PromotionInterface $promotion
    ) {
        try {
            $promotionModel = $this->promotionFactory->create();
            $this->resource->load($promotionModel, $promotion->getPromotionId());
            $this->resource->delete($promotionModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the promotion: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($promotionId)
    {
        return $this->delete($this->getById($promotionId));
    }
}
