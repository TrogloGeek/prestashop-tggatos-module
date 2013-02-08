<?php
class TggAtosSilentResponseModuleFrontController extends ModuleFrontController
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
		{
			header(null, null, 500);
			exit;
		}
		$response = $this->module->uncypherResponse($message, TggAtosModuleResponseObject::TYPE_USER);
		$this->module->processResponse($response);
	}
}