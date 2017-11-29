<?php

/**
 * Class TggAtosPaymentFailureModuleFrontController
 * @property TggAtos $module
 */
class TggAtosPaymentFailureModuleFrontController extends ModuleFrontController
{
	public $display_column_left = false;
	public $ssl = true;

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
		$response = $this->module->uncypherResponse(Tools::getValue('message'), TggAtosModuleResponseObject::TYPE_USER);
		$currencyCode = null;
		$this->module->decodeCaddieField($response->caddie, $currencyCode);
		$currency = Currency::getCurrencyInstance(Currency::getIdByIsoCode($currencyCode));
		/* @var $currency Currency */
		$amount = (float)$response->amount;
		if ($currency->decimals)
			$amount /= 100;
		$this->context->smarty->assign(array(
			'tggatos_response' => $response,
			'tggatos_pathURI' => $this->module->getPathUri(),
			'tggatos_amount' => $amount,
			'tggatos_currency' => $currency
		));
		$this->setTemplate('module:'.$this->module->name.'/views/templates/front/payment_failure.tpl');
	}
}
