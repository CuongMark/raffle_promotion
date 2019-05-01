<?php


namespace Angel\Promotion\Api\Data;

interface FreeInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const STATUS = 'status';
    const PRODUCT_ID = 'product_id';
    const TOTAL_TIME = 'total_time';
    const SORT_ORDER = 'sort_order';
    const BUY = 'buy';
    const FREE_ID = 'free_id';
    const FREE = 'free';

    /**
     * Get free_id
     * @return string|null
     */
    public function getFreeId();

    /**
     * Set free_id
     * @param string $freeId
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setFreeId($freeId);

    /**
     * Get buy
     * @return string|null
     */
    public function getBuy();

    /**
     * Set buy
     * @param string $buy
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setBuy($buy);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Promotion\Api\Data\FreeExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Angel\Promotion\Api\Data\FreeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Promotion\Api\Data\FreeExtensionInterface $extensionAttributes
    );

    /**
     * Get free
     * @return string|null
     */
    public function getFree();

    /**
     * Set free
     * @param string $free
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setFree($free);

    /**
     * Get sort_order
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Set sort_order
     * @param string $sortOrder
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Get total_time
     * @return string|null
     */
    public function getTotalTime();

    /**
     * Set total_time
     * @param string $totalTime
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setTotalTime($totalTime);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setStatus($status);

    /**
     * Get product_id
     * @return string|null
     */
    public function getProductId();

    /**
     * Set product_id
     * @param string $productId
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setProductId($productId);
}
