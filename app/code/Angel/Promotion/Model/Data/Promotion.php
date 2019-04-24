<?php


namespace Angel\Promotion\Model\Data;

use Angel\Promotion\Api\Data\PromotionInterface;

class Promotion extends \Magento\Framework\Api\AbstractExtensibleObject implements PromotionInterface
{

    /**
     * Get promotion_id
     * @return string|null
     */
    public function getPromotionId()
    {
        return $this->_get(self::PROMOTION_ID);
    }

    /**
     * Set promotion_id
     * @param string $promotionId
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setPromotionId($promotionId)
    {
        return $this->setData(self::PROMOTION_ID, $promotionId);
    }

    /**
     * Get buy
     * @return string|null
     */
    public function getBuy()
    {
        return $this->_get(self::BUY);
    }

    /**
     * Set buy
     * @param string $buy
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setBuy($buy)
    {
        return $this->setData(self::BUY, $buy);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Promotion\Api\Data\PromotionExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Angel\Promotion\Api\Data\PromotionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Promotion\Api\Data\PromotionExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get free
     * @return string|null
     */
    public function getFree()
    {
        return $this->_get(self::FREE);
    }

    /**
     * Set free
     * @param string $free
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setFree($free)
    {
        return $this->setData(self::FREE, $free);
    }

    /**
     * Get sort_order
     * @return string|null
     */
    public function getSortOrder()
    {
        return $this->_get(self::SORT_ORDER);
    }

    /**
     * Set sort_order
     * @param string $sortOrder
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORT_ORDER, $sortOrder);
    }

    /**
     * Get total_time
     * @return string|null
     */
    public function getTotalTime()
    {
        return $this->_get(self::TOTAL_TIME);
    }

    /**
     * Set total_time
     * @param string $totalTime
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setTotalTime($totalTime)
    {
        return $this->setData(self::TOTAL_TIME, $totalTime);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Angel\Promotion\Api\Data\PromotionInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
