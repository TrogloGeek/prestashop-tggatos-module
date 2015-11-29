<?php
if (!class_exists('TggAtosModuleFrontController', false)) {
	require_once implode(DIRECTORY_SEPARATOR, array(dirname(__FILE__), 'TggAtosModuleFrontController.php'));
}
class TggAtosUserReturnModuleFrontController extends TggAtosModuleFrontController
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
			Tools::redirectLink($this->context->link->getPageLink('history.php', true));
		$response = $this->module->uncypherResponse($message, TggAtosModuleResponseObject::TYPE_USER);
		$order = $this->module->processResponse($response);
		if ($order)
		{
			Tools::redirectLink(
				$this->context->link->getPageLink(
					'order-confirmation.php'
					, true
				)
				.'?'.http_build_query(
					array(
						'id_cart' => $order->id_cart
						, 'id_order' => $order->id
						, 'transaction_id' => $response->transaction_id
						, 'key' => $order->secure_key
						, 'id_module' => $this->module->id
						, 'tggatos_date' => date('Y-m-d')
					)
				)
			);
		}
		Tools::redirect(
			$this->module->getModuleLink(
				TggAtos::CTRL_PAYMENT_FAILURE
				, array('id_cart' => $response->order_id, 'transaction_id' => $response->transaction_id, 'tggatos_date' => date('Y-m-d'))
			)
		);
	}
}
