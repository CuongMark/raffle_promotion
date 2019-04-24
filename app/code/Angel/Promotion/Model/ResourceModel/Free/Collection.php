<?php


namespace Angel\Promotion\Model\ResourceModel\Free;

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
            \Angel\Promotion\Model\Free::class,
            \Angel\Promotion\Model\ResourceModel\Free::class
        );
    }
}
