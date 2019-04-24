<?php


namespace Angel\Promotion\Model\ResourceModel;

class Free extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('angel_promotion_free', 'free_id');
    }
}
