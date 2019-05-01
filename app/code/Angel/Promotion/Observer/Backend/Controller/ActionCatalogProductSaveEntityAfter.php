<?php


namespace Angel\Promotion\Observer\Backend\Controller;

use Angel\Promotion\Model\Data\Free;
use Angel\Promotion\Model\FreeManagement;
use Angel\Promotion\Model\FreeRepository;
use Angel\Promotion\Model\ResourceModel\Free\Collection;
use Angel\Promotion\Model\ResourceModel\Free\CollectionFactory;

class ActionCatalogProductSaveEntityAfter implements \Magento\Framework\Event\ObserverInterface
{

    private $freeManagement;
    private $freeCollectionFactory;
    private $freeRepository;
    private $freeData;

    public function __construct(
        FreeManagement $freeManagement,
        CollectionFactory $freeCollectionFactory,
        FreeRepository $freeRepository,
        Free $freeData
    ){
        $this->freeManagement = $freeManagement;
        $this->freeCollectionFactory = $freeCollectionFactory;
        $this->freeRepository = $freeRepository;
        $this->freeData = $freeData;
    }

    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();

        $frees = $product->getData('frees');

        if (is_array($frees)) {
            $existFree = [];

            foreach ($frees as $_free) {
                if (isset($_free['free_id']) && is_numeric($_free['free_id'])) {
                    $freeData = $this->freeRepository->getById($_free['free_id']);
                } else {
                    $freeData = $this->freeData;
                }
                $freeData->setProductId($product->getId())
                    ->setBuy($_free['buy'])
                    ->setFree($_free['free'])
                    ->setSortOrder($_free['sort_order']);
                $freeData = $this->freeRepository->save($freeData);
                $existFree[] = $freeData->getFreeId();
            }

            /** @var Collection $freesCollection */
            $freesCollection = $this->freeCollectionFactory->create();
            $freesCollection->addFieldToFilter('product_id',$product->getId())
                ->addFieldToFilter('free_id', ['nin' => $existFree]);
            foreach ($freesCollection as $free) {
                $this->freeRepository->delete($free->getDataModel());
            }
        }
    }
}