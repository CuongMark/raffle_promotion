<?php


namespace Angel\Promotion\Model;

use Angel\Promotion\Model\ResourceModel\Free\CollectionFactory as FreeCollectionFactory;
use Angel\Promotion\Api\Data\FreeSearchResultsInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Angel\Promotion\Model\ResourceModel\Free as ResourceFree;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Angel\Promotion\Api\FreeRepositoryInterface;
use Angel\Promotion\Api\Data\FreeInterfaceFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class FreeRepository implements FreeRepositoryInterface
{

    protected $freeFactory;

    protected $freeCollectionFactory;

    protected $dataObjectHelper;

    private $collectionProcessor;

    protected $dataObjectProcessor;

    protected $dataFreeFactory;

    protected $resource;

    protected $extensibleDataObjectConverter;
    protected $searchResultsFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;


    /**
     * @param ResourceFree $resource
     * @param FreeFactory $freeFactory
     * @param FreeInterfaceFactory $dataFreeFactory
     * @param FreeCollectionFactory $freeCollectionFactory
     * @param FreeSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceFree $resource,
        FreeFactory $freeFactory,
        FreeInterfaceFactory $dataFreeFactory,
        FreeCollectionFactory $freeCollectionFactory,
        FreeSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->freeFactory = $freeFactory;
        $this->freeCollectionFactory = $freeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFreeFactory = $dataFreeFactory;
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
        \Angel\Promotion\Api\Data\FreeInterface $free
    ) {
        /* if (empty($free->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $free->setStoreId($storeId);
        } */
        
        $freeData = $this->extensibleDataObjectConverter->toNestedArray(
            $free,
            [],
            \Angel\Promotion\Api\Data\FreeInterface::class
        );
        
        $freeModel = $this->freeFactory->create()->setData($freeData);
        
        try {
            $this->resource->save($freeModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the free: %1',
                $exception->getMessage()
            ));
        }
        return $freeModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($freeId)
    {
        $free = $this->freeFactory->create();
        $this->resource->load($free, $freeId);
        if (!$free->getId()) {
            throw new NoSuchEntityException(__('free with id "%1" does not exist.', $freeId));
        }
        return $free->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->freeCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Angel\Promotion\Api\Data\FreeInterface::class
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
        \Angel\Promotion\Api\Data\FreeInterface $free
    ) {
        try {
            $freeModel = $this->freeFactory->create();
            $this->resource->load($freeModel, $free->getFreeId());
            $this->resource->delete($freeModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the free: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($freeId)
    {
        return $this->delete($this->getById($freeId));
    }
}
