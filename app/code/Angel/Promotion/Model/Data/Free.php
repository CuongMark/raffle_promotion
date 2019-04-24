<?php


namespace Angel\Promotion\Model\Data;

use Angel\Promotion\Api\Data\FreeInterface;

class Free extends \Magento\Framework\Api\AbstractExtensibleObject implements FreeInterface
{

    /**
     * Get free_id
     * @return string|null
     */
    public function getFreeId()
    {
        return $this->_get(self::FREE_ID);
    }

    /**
     * Set free_id
     * @param string $freeId
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setFreeId($freeId)
    {
        return $this->setData(self::FREE_ID, $freeId);
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
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setBuy($buy)
    {
        return $this->setData(self::BUY, $buy);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Angel\Promotion\Api\Data\FreeExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Angel\Promotion\Api\Data\FreeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Angel\Promotion\Api\Data\FreeExtensionInterface $extensionAttributes
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
     * @return \Angel\Promotion\Api\Data\FreeInterface
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
     * @return \Angel\Promotion\Api\Data\FreeInterface
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
     * @return \Angel\Promotion\Api\Data\FreeInterface
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
     * @return \Angel\Promotion\Api\Data\FreeInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
