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
		$response = $this->module->getResponseFromLog(Tools::getValue('tggatos_date'), Tools::getValue('id_cart'));
		$this->context->smarty->assign(array(
			'tggatos_response' => $response,
			'tggatos_pathURI' => $this->module->getPathUri()
		));
		$this->setTemplate('payment_failure.tpl');
	}
}