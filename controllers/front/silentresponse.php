<?php
class TggAtosSilentResponseModuleFrontController extends ModuleFrontController
{
	public $display_column_left = false;
	public $ssl = false;

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
			header(null, null, 400);
			exit;
		}
		$response = $this->module->uncypherResponse($message, TggAtosModuleResponseObject::TYPE_SILENT);
		$id_cart = (int)$response->order_id;
		$lock = null;
		if ($this->module->tryCreateResponseLock($id_cart, $lock)) {
			$this->module->processResponse($response);
			$this->module->removeResponseLock($id_cart, $lock);
		}
		exit;
	}

	/**
	 * Block attempt to perform SSL redirection, breaking silent response
	 */
	protected function sslRedirection() {}
}
