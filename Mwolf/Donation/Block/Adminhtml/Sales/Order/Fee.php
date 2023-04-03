<?php
namespace Mwolf\Donation\Block\Adminhtml\Sales\Order;
use Magento\Sales\Model\Order;
 class Fee extends \Magento\Framework\View\Element\Template
 {
    /**
     * @var Order
     */
    protected $_order;
    /**
     * @var \Magento\Framework\DataObject
     */
    protected $_source;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }
    public function getSource()
    {
        return $this->_source;
    }
 
    public function displayFullSummary()
    {
        return true;
    }
    public function initTotals()
    {
        $parent = $this->getParentBlock();
        $this->_order = $parent->getOrder();
        $this->_source = $parent->getSource();
        $title = 'Donation Price';
        $store = $this->getStore();
        if($this->_order->getDonationPrice()!=0){
            $customAmount = new \Magento\Framework\DataObject(
                    [
                        'code' => 'donation_price',
                        'strong' => false,
                        'value' => $this->_order->getDonationPrice(),
                        'label' => __($title),
                    ]
                );
            $parent->addTotal($customAmount, 'donation_price');
        }
        return $this;
    }
    /**
     * Get order store object
     *
     * @return \Magento\Store\Model\Store
     */
    public function getStore()
    {
        return $this->_order->getStore();
    }
    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }
    /**
     * @return array
     */
    public function getLabelProperties()
    {
        return $this->getParentBlock()->getLabelProperties();
    }
    /**
     * @return array
     */
    public function getValueProperties()
    {
        return $this->getParentBlock()->getValueProperties();
    }
 }
