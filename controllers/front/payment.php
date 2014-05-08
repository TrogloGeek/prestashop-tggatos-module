<?php
class TggAtosPaymentModuleFrontController extends ModuleFrontController
{
	public $display_column_left = false;
	public $ssl = true;
	
	/**
	 *  @var TggAtos 
	 */
	public $module;
	
	public function init()
	{
		parent::init();
		
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
		
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
	}
	
	public function initContent()
	{
		parent::initContent();
		
		$mode = Tools::getValue('mode');
		if (!$this->module->canProcess($mode, $this->context->cart))
			Tools::redirect('index.php?controller=order&step=3');
	
		$this->context->currency = Currency::getCurrencyInstance(intval($this->context->cart->id_currency));
		
		$cartAmount = $this->context->cart->getOrderTotal();
		$feesAmount = $this->module->getPaymentFees($cartAmount, $this->context->currency, $mode);
		$totalAmount = $cartAmount + $feesAmount;
		
		$this->context->smarty->assign(array(
			'tggatos_cartAmount' => $cartAmount,
			'tggatos_feesAmount' => $feesAmount,
			'tggatos_totalAmount' => $totalAmount,
			'tggatos_mode' => $mode,
			'tggatos_form' => $this->module->getPaymentRedirectionForm(
				$totalAmount, 
				$this->context->currency, 
				$mode,
				array(
					'customer_id' => $this->context->customer->id,
					'order_id' => $this->context->cart->id
				)
			),
			'tggatos_paymentCurrency' => $this->context->currency,
			'tggatos_pathURI' => $this->module->getPathUri()
		));
		$this->setTemplate('payment_redirect_to_bank.tpl');
	}
}