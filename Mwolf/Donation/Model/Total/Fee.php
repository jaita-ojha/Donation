<?php
namespace Mwolf\Donation\Model\Total;
/**
* Class Fee
* @package Mwolf\Donation\Model\Total
*/
class Fee extends \Magento\Quote\Model\Quote\Address\Total\AbstractTotal
{
    /**
    * Collect grand total address amount
    * 
    * @param \Magento\Quote\Model\Quote $quote
    * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment
    * @param \Magento\Quote\Model\Quote\Address\Total $total
    * @return $this
    */
    protected $quoteValidator = null;
    protected $checkoutSession;
    public function __construct(
    \Magento\Quote\Model\QuoteValidator $quoteValidator,
    \Magento\Checkout\Model\Session $checkoutSession
    )
    {
    $this->quoteValidator = $quoteValidator;
    $this->checkoutSession   = $checkoutSession; 
    }
    public function collect(
        \Magento\Quote\Model\Quote $quote,
        \Magento\Quote\Api\Data\ShippingAssignmentInterface $shippingAssignment,
        \Magento\Quote\Model\Quote\Address\Total $total
    ){
        parent::collect($quote, $shippingAssignment, $total);
        $exist_amount = 0;
        $fee = $this->checkoutSession->getCustomFee();
        if($fee!='' || $fee!=0){
            $fee = $fee;
        }else{
            $fee = 0;
        }
        $balance = $fee - $exist_amount;
        $total->setTotalAmount('donation_price', $balance);
        $total->setBaseTotalAmount('donation_price', $balance);
        $total->setDonationPrice($balance);
        $total->setBaseFee($balance);
        $total->setGrandTotal($total->getGrandTotal());
        $total->setBaseGrandTotal($total->getBaseGrandTotal());
        $quote->setDonationPrice($balance);
        return $this;
    }
    protected function clearValues(Address\Total $total)
    {
        $total->setTotalAmount('subtotal', 0);
        $total->setBaseTotalAmount('subtotal', 0);
        $total->setTotalAmount('tax', 0);
        $total->setBaseTotalAmount('tax', 0);
        $total->setTotalAmount('discount_tax_compensation', 0);
        $total->setBaseTotalAmount('discount_tax_compensation', 0);
        $total->setTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setBaseTotalAmount('shipping_discount_tax_compensation', 0);
        $total->setSubtotalInclTax(0);
        $total->setBaseSubtotalInclTax(0);
    }
    /**
    * @param \Magento\Quote\Model\Quote $quote
    * @param Address\Total $total
    * return array|null
    */
    /**
    * Assign subtotal amount and label to address object
    * 
    * @param \Magento\Quote\Model\Quote $quote
    * @param Address\Total $total
    * @return array
    * @SuppressWarnings(PHPMD.UnusedFormalParameter)
    */
    public function fetch(\Magento\Quote\Model\Quote $quote, \Magento\Quote\Model\Quote\Address\Total $total)
    {
        $fee = $this->checkoutSession->getCustomFee();
        return [
        'code'=>'donation_price',
        'title'=>'Donate For Store',
        'value'=> $fee
        ];
    }
    /**
    * Get Subtotal label
    *
    * @return \Magento\Framework\Phrase
    */
    public function getLabel()
    {
        return __('Donate For Store');
    }
}
