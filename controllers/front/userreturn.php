<?php
class TggAtosUserReturnModuleFrontController extends ModuleFrontController
{
	public $display_column_left = false;
	public $ssl = true;

	/**
	 *  @var TggAtos
	 */
	public $module;

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