<?php
 
namespace Mwolf\Donation\Plugin;
 
use Magento\Sales\Api\Data\OrderInterface;
use Magento\Sales\Api\OrderManagementInterface;

class OrderPlace
{
    /**
     * @param OrderManagementInterface $subject
     * @param OrderInterface $order
     * @return OrderInterface
     */
    protected $_objectManager;
    public function __construct( \Magento\Framework\ObjectManagerInterface $objectmanager )
    {
        $this->_objectManager = $objectmanager;
    }
    public function afterPlace(
        OrderManagementInterface $subject,
        OrderInterface $order
    ) {
        $orderId = $order->getIncrementId();
        $quoteRepository = $this->_objectManager->create('Magento\Quote\Model\QuoteRepository');
        $quote = $quoteRepository->get($order->getQuoteId());
        $order->setDonationPrice($quote->getDonationPrice());
        $order->save();
        return $order;
    }
}