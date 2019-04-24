<?php


namespace Angel\Promotion\Api\Data;

interface FreeSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get free list.
     * @return \Angel\Promotion\Api\Data\FreeInterface[]
     */
    public function getItems();

    /**
     * Set buy list.
     * @param \Angel\Promotion\Api\Data\FreeInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
