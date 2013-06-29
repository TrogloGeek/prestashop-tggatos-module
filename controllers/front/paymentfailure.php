<?php
class TggAtosPaymentFailureModuleFrontController extends ModuleFrontController
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
		$response = $this->module->getResponseFromLog(Tools::getValue('tggatos_date'), Tools::getValue('id_cart'), Tools::getValue('transaction_id'));
		$currency = Currency::getCurrencyInstance(Currency::getIdByIsoCodeNum($response->currency_code));
		/* @var $currency Currency */
		$amount = floatval($response->amount);
		if ($currency->decimals)
			$amount /= 100;
		$this->context->smarty->assign(array(
			'tggatos_response' => $response,
			'tggatos_pathURI' => $this->module->getPathUri(),
			'tggatos_amount' => $amount,
			'tggatos_currency' => $currency
		));
		$this->setTemplate('payment_failure.tpl');
	}
}