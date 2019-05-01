<?php
/**
 * Created by PhpStorm.
 * User: mark
 * Date: 5/1/2019
 * Time: 8:03 PM
 */

namespace Angel\Promotion\Observer;

use Angel\Promotion\Model\FreeManagement;
use Magento\Framework\DataObject;
use Magento\Framework\Event\Observer;

class GetFreeTickets implements \Magento\Framework\Event\ObserverInterface
{
    private $freeManagement;

    public function __construct(
        FreeManagement $freeManagement
    ){
        $this->freeManagement = $freeManagement;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();
        $qty = $observer->getEvent()->getQty();
        /** @var DataObject $free */
        $free = $observer->getEvent()->getFree();
        $freeTicket = $this->freeManagement->getFreeTickets($product->getId(), $qty);
        $free->setData('free_ticket', $freeTicket);
    }
}