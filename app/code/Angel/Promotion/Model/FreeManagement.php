<?php

namespace Angel\Promotion\Model;

use Angel\Promotion\Model\ResourceModel\Free\Collection;
use Angel\Promotion\Model\ResourceModel\Free\CollectionFactory;

class FreeManagement{
    private $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ){
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param int $productId
     * @return Collection
     */
    public function getPromotionByProductId($productId){
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        return $collection->addFieldToFilter('product_id', $productId)
            ->setOrder('buy');
    }

    /**
     * @param int $productId
     * @param int $qty
     * @return float|int
     */
    public function getFreeTickets($productId, $qty){
        $promotions = $this->getPromotionByProductId($productId);
        $freeTicket = 0;
        foreach ($promotions as $free){
            if ($free->getBuy() > 0) {
                $times = (int)($qty / $free->getBuy());
                $freeTicket += $times*$free->getFree();
                $qty = $qty%$free->getBuy();
            }
        }
        return $freeTicket;
    }
}