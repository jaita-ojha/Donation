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
    protected $quoteRepository;

    public function __construct( 
        
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    )

    {
        $this->quoteRepository = $quoteRepository;
    }
    public function afterPlace(
        OrderManagementInterface $subject,
        OrderInterface $order
    ) {
        $orderId = $order->getIncrementId();
        $quote = $this->quoteRepository->get($order->getQuoteId());
        $order->setDonationPrice($quote->getDonationPrice());
        $order->save();
        return $order;
    }
}