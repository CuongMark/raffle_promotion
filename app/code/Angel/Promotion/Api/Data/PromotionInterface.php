<?php


namespace Angel\Promotion\Api\Data;

interface PromotionInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const STATUS = 'status';
    const TOTAL_TIME = 'total_time';
    const SORT_ORDER = 'sort_order';
    const BUY = 'buy';
    const PROMOTION_ID = 'promotion_id';
    const FREE = 'free';

    /**
     * Get promotion_id
     * @return string|null
     */
    public function getPromotionId();

    /**
     * Set promotion_id
     * @param string $promotionId
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setPromotionId($promotionId);

    /**
     * Get buy
     * @return string|null
     */
    public function getBuy();

    /**
     * Set buy
     * @param string $buy
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setBuy($buy);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Promotion\Api\Data\PromotionExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Angel\Promotion\Api\Data\PromotionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Promotion\Api\Data\PromotionExtensionInterface $extensionAttributes
    );

    /**
     * Get free
     * @return string|null
     */
    public function getFree();

    /**
     * Set free
     * @param string $free
     * @return \Angel\Promotion\Api\Data\PromotionInterface
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
     * @return \Angel\Promotion\Api\Data\PromotionInterface
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
     * @return \Angel\Promotion\Api\Data\PromotionInterface
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
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setStatus($status);
}
