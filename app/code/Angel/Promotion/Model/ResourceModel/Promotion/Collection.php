<?php


namespace Angel\Promotion\Model\ResourceModel\Promotion;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Angel\Promotion\Model\Promotion::class,
            \Angel\Promotion\Model\ResourceModel\Promotion::class
        );
    }
}
