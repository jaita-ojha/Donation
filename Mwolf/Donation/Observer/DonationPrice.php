<?php
    /**
     * Mwolf Donation Donation Observer
     *
     * @category    Mwolf
     * @package     Mwolf_Donation
     * @author      Meta Wolf
     *
     */
    namespace Mwolf\Donation\Observer;
 
    use Magento\Framework\Event\ObserverInterface;
    use Magento\Framework\App\RequestInterface;
 
    class DonationPrice implements ObserverInterface
    {
        protected $request;
        protected $checkoutSession;

        public function __construct(
            \Magento\Framework\App\RequestInterface $request,
            \Magento\Checkout\Model\Session $checkoutSession
        ) { 
            $this->request = $request; 
            $this->checkoutSession   = $checkoutSession;           
        }
        public function execute(\Magento\Framework\Event\Observer $observer) {   
            $postData = $this->request->getParam('donation_price'); 
            $customFee = $this->checkoutSession->setCustomFee($postData);            
        }
 
    }