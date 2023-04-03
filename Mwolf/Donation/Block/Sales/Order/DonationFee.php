<?php
namespace Mwolf\Donation\Block\Sales\Order;

use Magento\Framework\View\Element\Template\Context;
 
class DonationFee extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->setInitialFields();
    }
 
    public function setInitialFields()
    {
        if (!$this->getLabel())
        {
            $this->setLabel(__('Donation Price'));
        }
    }
 
    public function initTotals()
    {
        $this->getParentBlock()->addTotal(
            new \Magento\Framework\DataObject(
                [
                    'code' => 'donation_price',
                    'strong' => $this->getStrong(),
                    'value' => $this->getOrder()->getDonationPrice(),
                    'base_value' => $this->getOrder()->getDonationPrice(),
                    'label' => __($this->getLabel()),
                ]
            ),
            $this->getAfter()
        );
        return $this;
    }
 
    public function getOrder()
    {
        return $this->getParentBlock()->getOrder();
    }
 
    public function getSource()
    {
        return $this->getParentBlock()->getSource();
    }
}