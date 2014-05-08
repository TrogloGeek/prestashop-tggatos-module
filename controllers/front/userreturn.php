<?php
class TggAtosUserReturnModuleFrontController extends ModuleFrontController
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
		$message = Tools::getValue('DATA');
		if (empty($message))
			Tools::redirect('index.php?controller=history');
		$response = $this->module->uncypherResponse($message, TggAtosModuleResponseObject::TYPE_USER);
		$order = $this->module->processResponse($response);
		if ($order)
		{
			Tools::redirect('index.php?controller=order-confirmation&id_cart='.$order->id_cart.'&id_order='.$order->id.'&transaction_id='.urlencode($response->transaction_id).'&key='.urlencode($order->secure_key).'&id_module='.$this->module->id.'&tggatos_date='.date('Y-m-d'));
		}
		Tools::redirect('index.php?fc=module&module='.$this->module->name.'&controller=paymentfailure&id_cart='.$response->order_id.'&transaction_id='.urlencode($response->transaction_id).'&tggatos_date='.date('Y-m-d'));
	}
}