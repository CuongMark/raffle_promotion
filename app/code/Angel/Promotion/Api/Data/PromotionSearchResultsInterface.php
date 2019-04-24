<?php


namespace Angel\Promotion\Api\Data;

interface PromotionSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get promotion list.
     * @return \Angel\Promotion\Api\Data\PromotionInterface[]
     */
    public function getItems();

    /**
     * Set buy list.
     * @param \Angel\Promotion\Api\Data\PromotionInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
