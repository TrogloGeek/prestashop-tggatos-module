<?php
/**
 * Atos/SIPS connector for Prestashop 1.5.x
 * @license GNU/GPL version 3
 * @author Damien VERON (TrogloGeek)
 * @website http://prestashop.blog.capillotracteur.fr 
 *
 */

class TggAtos extends PaymentModule 
{
	const IN_NONE = 0;
	const IN_TEXT = 1;
	const IN_SELECT = 2;
	const IN_CHECKBOX = 3;
	const IN_INTERNAL = 4;
	
	const T_NONE = 0;
	const T_BOOL = 1;
	const T_INT = 2;
	const T_UNSIGNED_INT = 3;
	const T_ABS_POSITIVE_INT = 4;
	const T_FLOAT = 5;
	const T_UNSIGNED_FLOAT = 6;
	const T_STRING = 7;
	const T_PATH = 8;
	const T_URI = 9;
	
	const FEES_TOTAL = 0;
	const FEES_FIXED = 1;
	const FEES_PERCENT = 2;
	
	const RETURN_PROTOCOL_AUTO = '';
	const RETURN_PROTOCOL_HTTP = 'http://';
	const RETURN_PROTOCOL_HTTPS = 'https://';
	
	const RETURN_DOMAIN_AUTO = '';
	
	const RETURN_CONTEXT_USER = 'user';
	const RETURN_CONTEXT_SILENT = 'silent';
	
	const BANK_CONTROLLER_USER = 'autodispatch/userreturn.pub.php';
	
	const BLOCK_ALIGN_CENTER = 'center';
	const BLOCK_ALIGN_LEFT = 'left';
	const BLOCK_ALIGN_RIGHT = 'right';
	
	const BIN_REQUEST = 'request';
	const BIN_RESPONSE = 'response';
	
	const PATHFILE = 'pathfile';
	const PARMCOM = 'parmcom';
	const CERTIF = 'certif';
	
	const PATHFILE_VARLENGTH = 78;
	const RECEIPT_COMPLEMENT_MAXLENGTH = 3072;
	
	const MODE_SINGLE = 1;
	const MODE_2TPAYMENT = 2;
	const MODE_3TPAYMENT = 3;
	
	const TABLE_TRANSACTION_TODAY = '_transactions_today';
	
	const ATOS_FIELD_TRANSACTION_ID = 'transaction_id';
	const ATOS_FIELD_AUTHORISATION_ID = 'authorisation_id';
	const ATOS_FIELD_PAYMENT_CERTIFICATE = 'payment_certificate';
	
	//INTERNAL conf
	const CNF_VERSION = 'VERSION';
	
	const CONVERT_TO_DEFAULT = 1;
	const CONVERT_FROM_DEFAULT = 2;
	
	//BASIC conf
	const CNF_BANK = 'BANK';
	const CNF_PRODUCTION = 'PRODUCTION';
	const CNF_MERCHANT_ID = 'MERCHANT_ID';
	const CNF_ISO_LANG = 'ISO_LANG';
	const CNF_CAPTURE_DAY = 'CAPTURE_DAY';
	const CNF_CAPTURE_MODE = 'CAPTURE_MODE';
	const CNF_RESPONSE_LOG_TXT = 'RESPONSE_LOG_TXT';
	const CNF_RESPONSE_LOG_CSV = 'RESPONSE_LOG_CSV';
	const CNF_LOG_PATH = 'LOG_PATH';
	const CNF_ORDER_MESSAGE = 'ORDER_MESSAGE';
	const CNF_CHECK_VERSION = 'CHECK_VERSION';
	const CNF_OS_PAYMENT_CANCELLED = 'OS_PAYMENT_CANCELLED';
	const CNF_OS_PAYMENT_FAILED = 'OS_PAYMENT_FAILED';
	
	//SINGLE conf
	const CNF_SINGLE = 'SINGLE';
	const CNF_PAYMENT_MEANS = 'PAYMENT_MEANS';
	const CNF_MINAMOUNT = 'MINAMOUNT';
	const CNF_OS_PAYMENT_SUCCESS = 'OS_PAYMENT_SUCCESS';
	const CNF_PAYMENT_FEES = 'PAYMENT_FEES';
	const CNF_PAYMENT_FEES_P = 'PAYMENT_FEES_P';
	
	//GRAPHIC conf
	const CNF_CARD_IMG_PATH = 'CARD_IMG_PATH';
	const CNF_BLOCK_ALIGN = 'BLOCK_ALIGN';
	const CNF_BLOCK_ORDER = 'BLOCK_ORDER';
	const CNF_HEADER_FLAG = 'HEADER_FLAG';
	const CNF_TARGET = 'TARGET';
	const CNF_TEMPLATE_FILE = 'TEMPLATE_FILE';
	const CNF_LOGO_LEFT = 'LOGO_LEFT';
	const CNF_LOGO_CENTER = 'LOGO_CENTER';
	const CNF_LOGO_RIGHT = 'LOGO_RIGHT';
	const CNF_LOGO_SUBMIT = 'LOGO_SUBMIT';
	const CNF_LOGO_NORMAL_RETURN = 'LOGO_NORMAL_RETURN';
	const CNF_LOGO_CANCEL_RETURN = 'LOGO_CANCEL_RETURN';
	const CNF_BG_IMAGE = 'BG_IMAGE';
	const CNF_BG_COLOR = 'BG_COLOR';
	const CNF_TXT_COLOR = 'TXT_COLOR';
	const CNF_TXT_FONT = 'TXT_FONT';
	
	//ADVANCED conf
	const CNF_NO_TID_GENERATION = 'NO_TID_GENERATION';
	const CNF_MIN_TID = 'MIN_TID';
	const CNF_MAX_TID = 'MAX_TID';
	const CNF_FORCE_RETURN = 'FORCE_RETURN';
	const CNF_SKIP_REDIRECTION_CONTROLLER = 'SKIP_REDIRCTRL';
	const CNF_OP_FIELD_TID = 'OP_FIELD_TID';
	const CNF_BINARIES_IN_PATH = 'BINARIES_IN_PATH';
	const CNF_BIN_PATH = 'BIN_PATH';
	const CNF_BIN_SUFFIX = 'BIN_SUFFIX';
	const CNF_PARAM_PATH = 'PARAM_PATH';
	const CNF_RETURN_PROTOCOL_USER = 'RETURN_PROTOCOL_USER';
	const CNF_RETURN_DOMAIN_USER = 'RETURN_DOMAIN_USER';
	const CNF_RETURN_DOMAIN_SILENT = 'RETURN_DOMAIN_SILENT';
	const CNF_DEBUG_MODE = 'DEBUG_MODE';
	const CNF_TID_TZ = 'TID_TZ';
	
	//23TIMES conf
	const CNF_2TPAYMENT = '2TPAYMENT';
	const CNF_2TPAYMENT_MEANS = '2TPAYMENT_MEANS';
	const CNF_2TPAYMENT_MINAMOUNT = '2TPAYMENT_MINAMOUNT';
	const CNF_2TPAYMENT_SPACING = '2TPAYMENT_SPACING';
	const CNF_2TPAYMENT_DELAY = '2TPAYMENT_DELAY';
	const CNF_2TPAYMENT_OS = '2TPAYMENT_OS';
	const CNF_2TPAYMENT_FEES = '2TPAYMENT_FEES';
	const CNF_2TPAYMENT_FEES_P = '2TPAYMENT_FEES_P';
	const CNF_2TPAYMENT_FP_FXD = '2TPAYMENT_FP_FXD';
	const CNF_2TPAYMENT_FP_PCT = '2TPAYMENT_FP_PCT';
	const CNF_3TPAYMENT = '3TPAYMENT';
	const CNF_3TPAYMENT_MEANS = '3TPAYMENT_MEANS';
	const CNF_3TPAYMENT_MINAMOUNT = '3TPAYMENT_MINAMOUNT';
	const CNF_3TPAYMENT_SPACING = '3TPAYMENT_SPACING';
	const CNF_3TPAYMENT_DELAY = '3TPAYMENT_DELAY';
	const CNF_3TPAYMENT_OS = '3TPAYMENT_OS';
	const CNF_3TPAYMENT_FEES = '3TPAYMENT_FEES';
	const CNF_3TPAYMENT_FEES_P = '3TPAYMENT_FEES_P';
	const CNF_3TPAYMENT_FP_FXD = '3TPAYMENT_FP_FXD';
	const CNF_3TPAYMENT_FP_PCT = '3TPAYMENT_FP_PCT';
	
	const FILE_ERROR_LOG = 'error.log';
	
	/**
	 * @var array
	 */
	private $_confVars;
	/**
	 * @var array
	 */
	private $_confVarsByName;
	
	/**
	 * @var array
	 */
	private $_newConfVars = array();
	
	private $_banks = array(
		'' => '',
		'cyberplus' => 'CyberPlus - Banque Populaire',
		'etransactions' => 'E-Transactions - Crédit Agricole',
		'elysnet' => 'ElysNet - CCF/HSBC',
		'mercanet' => 'Mercanet - BNP',
		'scelliusnet' => 'ScelliusNet - La Banque Postale',
		'sherlocks' => 'Sherlocks - LCL',
		'sogenactif' => 'Sogenactif - Société Générale',
		'webaffaires' => 'WebAffaires - Crédit du Nord',
		'citelis' => 'Citélis',
		'smc' => 'Société Marseillaise de Crédit'
	);
	private $_demoCertificates = array(
		'cyberplus' => '038862749811111',
		'etransactions' => '013044876511111',
		'elysnet' => '014102450311111',
		'mercanet' => '082584341411111',
		'scelliusnet' => '014141675911111',
		'sherlocks' => '014295303911111',
		'sogenactif' => '014213245611111',
		'webaffaires' => '014022286611111',
		'citelis' => '029800266211111',
		'smc' => '011223344551111'
	);
	
	private $_hasTransacIDAvailableCached = null;
	
	/**
	 * Module's constructor
	 */
	public function __construct() 
	{
		$this->name = strtolower(get_class($this));
		$this->author = 'TrogloGeek';
		$this->tab = 'payments_gateways';
		$this->need_instance = 1;
		$this->version = '3.2.1';
		$this->currencies_mode = 'checkbox';
		$this->ps_versions_compliancy['min'] = '1.5.0.1';
		$this->ps_versions_compliancy['max'] = '1.6';
		parent::__construct();
		if (empty($this->_path))
			$this->_path = __PS_BASE_URI__.'modules/'.$this->name.'/';
		$this->displayName = $this->l('CC Payment with SIPS/ATOS');
		$this->description = $this->l('SIPS/ATOS payment module by TrogloGeek');
		$this->confirmUninstall = $this->l('Uninstall this module will erase your configuration including current transaction ID, continue ?');
		if ($this->context->employee instanceof Employee
				&& $this->context->employee->isLoggedBack()
				&& ($this->context->controller instanceof AdminModulesController)
				&& !in_array($this->name, explode('|', Tools::getValue('configure', ''))))
		{
			$this->autoCheck();
		}
	}
	
	/**
	 * Returns internal configuration value
	 * @param string $varname name of internal configuration variable to fetch
	 * @return string
	 */
	public function get($varname)
	{
		$this->initConfVars();
		$value = Configuration::get(strtoupper($this->name).'_'.$varname);
		if ($this->_confVarsByName[$varname]['type'] == self::T_BOOL)
			$value = (bool)$value;
		return $value;
	}
	
	/**
	 * Sets internal configuration value
	 * @param string $varname name of internal configuration variable to set
	 * @param string $value value to set
	 * @return boolean Update result
	 */
	public function set($varname, $value) 
	{
		$this->initConfVars();
		switch ($this->_confVarsByName[$varname]['type'])
		{
			case self::T_NONE:
				return false;
			case self::T_BOOL:
				$value = intval((bool)$value);
				break;
			case self::T_INT:
				$value = intval($value);
				break;
			case self::T_UNSIGNED_INT:
				$value = max(intval($value), 0);
				break;
			case self::T_ABS_POSITIVE_INT:
				$value = max(intval($value), 1);
				break;
			case self::T_FLOAT:
				if (is_string($value))
				{
					$localeinfo = localeconv();
					$value = preg_replace('/[.,]/', $localeinfo['decimal_point'], $value);
				}
				$value = floatval($value);
				break;
			case self::T_UNSIGNED_FLOAT:
				if (is_string($value))
				{
					$localeinfo = localeconv();
					$value = preg_replace('/[.,]/', $localeinfo['decimal_point'], $value);
				}
				$value = max(floatval($value), 0.0);
				break;
			case self::T_STRING:
			case self::T_URI:
				$value = (string)$value;
				break;
			case self::T_PATH:
				$value = rtrim((string)$value, '/\\').DIRECTORY_SEPARATOR;
				break;
			default:
				throw new PrestaShopModuleException('Unknown type for confVar '.$varname);
		}
		return Configuration::updateValue(strtoupper($this->name).'_'.$varname, $value);
	}
	
	public function deleteVar($varname)
	{
		Configuration::deleteByName(strtoupper($this->name).'_'.$varname);
	}
	
	public function getTable($table, $addPrefix = true)
	{
		return ($addPrefix ? _DB_PREFIX_ : '').$this->name.$table;
	}
	
	public function install()
	{
		$result = true;
		try {
			if (!parent::install()) {
				throw new Exception($this->l('Fatal error: parent::install(): Prestashop internal module installation procedure failed, installation can\'t go any further.'));
			}
		} catch (Exception $e) 
		{
			$result = false;
			$this->_errors[] = sprintf('%s(%u): %s'.PHP_EOL.'%s'.PHP_EOL.'%s', $e->getFile(), $e->getLine(), $e->getMessage(), $e->getTraceAsString(), $e->getPrevious());
		}
		foreach (array('displayPayment', 'displayPaymentReturn') as $hook)
			if ($result)
			{
				if (!$this->registerHook($hook))
				{
					$result = false;
					$this->_errors[] = sprintf($this->l('Unable to subscribe to hook %s'), $hook);
				}
			}
		if ($result)
		{
			$DB = Db::getInstance(TRUE);
			try {
				if (!$DB->execute('
					CREATE TABLE IF NOT EXISTS `'.$this->getTable(self::TABLE_TRANSACTION_TODAY).'` (
						`date`				DATE				NOT NULL,
						`transaction_id`	MEDIUMINT UNSIGNED	NOT NULL	AUTO_INCREMENT,
						PRIMARY KEY (`date`,`transaction_id`)
					)
					ENGINE=MyISAM
					;
				', false)) {
					throw new Exception(sprintf($this->l('Fatal error: Installation of the database table failed, error code: %u, error message: %s'), $DB->getNumberError(), $DB->getMsgError()));
				}
			}
			catch (Exception $e)
			{
				$result = false;
				$this->_errors[] = sprintf('%s(%u): %s'.PHP_EOL.'%s'.PHP_EOL.'%s', $e->getFile(), $e->getLine(), $e->getMessage(), $e->getTraceAsString(), $e->getPrevious());
			}
		}
		if ($result)
		{
			$this->setDefaults();
			$this->updateAtosParamFiles();
		}
		else 
		{
			parent::uninstall();
		}
		return $result;
	}
	
	public function uninstall()
	{
		Db::getInstance(TRUE)->execute('DROP TABLE IF EXISTS `'.$this->getTable(self::TABLE_TRANSACTION_TODAY).'`', false);
		$this->initConfVars();
		foreach ($this->_confVarsByName as $varname)
			$this->deleteVar($varname);
		return parent::uninstall();
	}
	
	/**
	 * Check if this payment method can be used, with optionnal additionnal checks against cart
	 * @param int $mode self::MODE_* or NULL to perform only basic health checks
	 * @param Cart $cart
	 * @param bool $skipHealthChecks
	 */
	public function canProcess($mode = NULL, Cart $cart = null, $skipHealthChecks = FALSE)
	{
		if (!$this->id)
			return false;
		if (!$this->active)
			return false;
		
		switch ($mode)
		{
			case self::MODE_SINGLE:
				if (!$this->get(self::CNF_SINGLE)) return false;
				break;
			case self::MODE_2TPAYMENT:
				if (!$this->get(self::CNF_2TPAYMENT)) return false;
				break;
			case self::MODE_3TPAYMENT:
				if (!$this->get(self::CNF_3TPAYMENT)) return false;
				break;
			case NULL:
				break;
			default:
				throw new PrestaShopModuleException('Invalid Argument $mode');
		}
		
		if (!$skipHealthChecks) {
			if (!$this->get(self::CNF_BANK) || !array_key_exists($this->get(self::CNF_BANK), $this->_banks))
				return false;
			if ($this->get(self::CNF_PRODUCTION) && !$this->get(self::CNF_MERCHANT_ID))
				return false;
			if (!$this->get(self::CNF_NO_TID_GENERATION))
			{
				if ($this->get(self::CNF_MIN_TID) > $this->get(self::CNF_MAX_TID))
					return false;
				$last_tid = Db::getInstance(TRUE)->getValue('SELECT max(transaction_id) as value FROM `'.$this->getTable(self::TABLE_TRANSACTION_TODAY).'` WHERE `date` = \''.date('Y-m-d').'\'', FALSE);
				if (!empty($last_tid) && intval($last_tid) >= $this->get(self::CNF_MAX_TID))
					return false;
			}
		}
		
		if (!is_null($mode) && !empty($cart)) {
			if ($cart->getOrderTotal() < $this->defaultCurrencyConvert($this->getMinAmount($mode), $cart->id_currency, self::CONVERT_FROM_DEFAULT))
				return false;
		}
		return true;
	}
	
	/**
	 * Hook displayPayment which displays available payment methods
	 * @param array $params Hook params
	 * @return boolean|string
	 */
	public function hookDisplayPayment($params)
	{
		if (!$this->canProcess())
			return false;
		$cart = $params['cart'];
		/* @var $cart Cart */
		$this->smarty->assign(array(
			'TggAtos' => $this,
			'tggatos_cart' => $cart
		), null, true);
		
		if ($this->get(self::CNF_SKIP_REDIRECTION_CONTROLLER))
		{
			$transaction_id = $this->generateTransactionId();
			if (!$transaction_id)
			{
				$this->error(__LINE__, 'No transaction_id generated', 3, null, false);
				return false;
			}
			$currency = Currency::getCurrencyInstance(intval($cart->id_currency));
			$cartAmount = $cart->getOrderTotal();
			$mergeParams = array(
				'customer_id' => $this->context->customer->id,
				'order_id' => $cart->id 
			);
			if ($this->canProcess(self::MODE_SINGLE, $cart, true))
			{
				$singleAmount = $cartAmount + $this->getPaymentFees($cartAmount, $currency, self::MODE_SINGLE);
				$this->smarty->assign(array(
					'tggatos_singleAmount' => $singleAmount,
					'tggatos_singleForm' => $this->getPaymentRedirectionForm(
						$singleAmount,
						$currency,
						self::MODE_SINGLE,
						$mergeParams,
						$transaction_id
					)
				), null, true);
			} else {
				$this->smarty->assign('tggatos_singleForm', false, true);
			}
			if ($this->canProcess(self::MODE_2TPAYMENT, $cart, true))
			{
				$m2tAmount = $cartAmount + $this->getPaymentFees($cartAmount, $currency, self::MODE_2TPAYMENT);
				$this->smarty->assign(array(
					'tggatos_2tAmount' => $m2tAmount,
					'tggatos_2tForm' => $this->getPaymentRedirectionForm(
						$m2tAmount,
						$currency,
						self::MODE_2TPAYMENT,
						$mergeParams,
						$transaction_id
					)
				), null, true);
			} else {
				$this->smarty->assign('tggatos_2tForm', false, true);
			}
			if ($this->canProcess(self::MODE_3TPAYMENT, $cart, true))
			{
				$m3tAmount = $cartAmount + $this->getPaymentFees($cartAmount, $currency, self::MODE_3TPAYMENT);
				$this->smarty->assign(array(
					'tggatos_3tAmount' => $m3tAmount,
					'tggatos_3tForm' => $this->getPaymentRedirectionForm(
						$m3tAmount,
						$currency,
						self::MODE_3TPAYMENT,
						$mergeParams,
						$transaction_id
					)
				), null, true);
			} else {
				$this->smarty->assign('tggatos_3tForm', false, true);
			}
			return $this->display(__FILE__, 'direct_payment.tpl');
		} else {
			$this->smarty->assign(array(
				'tggatos_modeSingleLink' => $this->context->link->getModuleLink($this->name, 'payment', array('mode' => self::MODE_SINGLE)),
				'tggatos_mode2tLink' => $this->context->link->getModuleLink($this->name, 'payment', array('mode' => self::MODE_2TPAYMENT)),
				'tggatos_mode3tLink' => $this->context->link->getModuleLink($this->name, 'payment', array('mode' => self::MODE_3TPAYMENT))
			));
			return $this->display(__FILE__, 'payment.tpl');
		}
	}
	
	public function hookDisplayPaymentReturn($params)
	{
		$this->smarty->assign('tggatos_response', $this->getResponseFromLog(Tools::getValue('tggatos_date'), Tools::getValue('id_cart'), Tools::getValue('transaction_id')));
		return $this->display(__FILE__, 'payment_return.tpl');
	}
	
	/**
	 * Generate payment redirection form by calling request binary of ATOS SIPS API
	 * @param float $amount
	 * @param Currency $currency
	 * @param int $mode self::MODE_*
	 * @param array $mergeParams
	 * @param string $transaction_id
	 * @return boolean|string
	 */
	public function getPaymentRedirectionForm($amount, Currency $currency, $mode, $mergeParams = array(), $transaction_id = NULL)
	{
		$atosAmount = $amount;
		if ($currency->decimals)
			$atosAmount *= 100;
		
		$data = array();
		$params = array(
			'language' => $this->get(self::CNF_ISO_LANG) ? $this->get(self::CNF_ISO_LANG) : $this->context->language->iso_code,
			'merchant_id' => $this->get(self::CNF_PRODUCTION) ? $this->get(self::CNF_MERCHANT_ID) : $this->_demoCertificates[$this->get(self::CNF_BANK)],
			'currency_code' => $currency->iso_code_num,
			'amount' => intval(round($atosAmount)),
			'pathfile' => $this->get(self::CNF_PARAM_PATH).self::PATHFILE,
			'normal_return_url' => $this->getBankReturnUri(self::RETURN_CONTEXT_USER),
			'cancel_return_url' => $this->getBankReturnUri(self::RETURN_CONTEXT_USER),
			'automatic_response_url' => $this->getBankReturnUri(self::RETURN_CONTEXT_SILENT)
		);
		if (!empty($_SERVER['REMOTE_ADDR']))
		{
			$params['customer_ip_address'] = substr($_SERVER['REMOTE_ADDR'], max(0, strlen($_SERVER['REMOTE_ADDR']) - 20), min(19, strlen($_SERVER['REMOTE_ADDR'])));
		}
		if (strlen($this->context->customer->email) <= 128)
			$params['customer_email'] = $this->context->customer->email;
		if (!is_null($transaction_id))
		{
			$params['transaction_id'] = $transaction_id;
		} elseif (!$this->get(self::CNF_NO_TID_GENERATION)) {
			$params['transaction_id'] = $this->generateTransactionId();
			if (empty($params['transaction_id']))
			{
				$this->error(__LINE__, 'No transaction_id has been generated', 4);
				return false;
			}
		}
		switch ($mode)
		{
			case self::MODE_SINGLE:
				$params['payment_means'] = $this->get(self::CNF_PAYMENT_MEANS);
				$params['capture_mode'] = $this->get(self::CNF_CAPTURE_MODE);
				$params['capture_day'] = $this->get(self::CNF_CAPTURE_DAY);
				break;
			case self::MODE_2TPAYMENT:
				$params['payment_means'] = $this->get(self::CNF_2TPAYMENT_MEANS);
				$params['capture_mode'] = 'PAYMENT_N';
				$params['capture_day'] = $this->get(self::CNF_2TPAYMENT_DELAY);
				$initialAmount = $this->defaultCurrencyConvert($this->get(self::CNF_2TPAYMENT_FP_FXD), $currency, self::CONVERT_FROM_DEFAULT) + $this->get(self::CNF_2TPAYMENT_FP_PCT) / 100 * $amount;
				if ($currency->decimals)
					$initialAmount *= 100;
				$initialAmount = str_pad((string)intval(Tools::ps_round($initialAmount)), 3, '0', STR_PAD_LEFT);
				array_push($data, 'NB_PAYMENT=2', 'PERIOD='.$this->get(self::CNF_2TPAYMENT_SPACING), 'INITIAL_AMOUNT='.$initialAmount);
				break;
			case self::MODE_3TPAYMENT:
				$params['payment_means'] = $this->get(self::CNF_3TPAYMENT_MEANS);
				$params['capture_mode'] = 'PAYMENT_N';
				$params['capture_day'] = $this->get(self::CNF_3TPAYMENT_DELAY);
				$initialAmount = $this->defaultCurrencyConvert($this->get(self::CNF_3TPAYMENT_FP_FXD), $currency, self::CONVERT_FROM_DEFAULT) + $this->get(self::CNF_3TPAYMENT_FP_PCT) / 100 * $amount;
				if ($currency->decimals)
					$initialAmount *= 100;
				$initialAmount = str_pad((string)intval(Tools::ps_round($initialAmount)), 3, '0', STR_PAD_LEFT);
				array_push($data, 'NB_PAYMENT=3', 'PERIOD='.$this->get(self::CNF_3TPAYMENT_SPACING), 'INITIAL_AMOUNT='.$initialAmount);
				break;
		}
		if ($this->get(self::CNF_FORCE_RETURN))
			array_push($data, 'NO_RESPONSE_PAGE');
		$this->initConfVars();
		foreach ($this->_confVarsByName as $name => $varconf)
			if (!empty($varconf['autofeed']) && !empty($varconf['atos']))
				$params[$varconf['atos']] = $this->get($name);
		if (isset($mergeParams['data']))
		{
			if (is_null($mergeParams['data']))
			{
				$data = array();
			} else {
				$mergeData = is_array($mergeParams['data']) ? $mergeParams['data'] : explode(';', $mergeParams['data']);
				$data = array_merge($data, $mergeData);
				unset($mergeData);
			}
		}
		$params['data'] = implode(';', $data);
		$params = array_merge($params,$mergeParams);
		if (!isset($params['receipt_complement']))
		{
			//This parameter is generated only if not overriden as we don't want to waste processing resources
			// passing this parameter with value boolean FALSE will forbid template to be called
			// and receipt_complement to be populated in ATOS SIPS API request call
			$this->smarty->assign(array(
				'TggAtos' => $this,
				'tggatos_cart' => $this->context->cart,
				'tggatos_params' => $params,
				'tggatos_mode' => $mode,
				'tggatos_fromCharset' => 'UTF-8',
				'tggatos_toCharset' => 'ISO-8859-1//TRANSLIT'
			), null, true);
			$params['receipt_complement'] = trim($this->display(__FILE__, 'param_receipt_complement.tpl'));
			//Charsets can be overriden by in-template assignation with scope="parent"
			$fromCharset = $this->smarty->getTemplateVars('tggatos_fromCharset');
			$toCharset = $this->smarty->getTemplateVars('tggatos_toCharset');
			$this->smarty->clearAssign('tggatos_fromCharset');
			$this->smarty->clearAssign('tggatos_toCharset');
			if (!empty($params['receipt_complement'])) {
				$params['receipt_complement'] = iconv($fromCharset, $toCharset, $params['receipt_complement']);
				if ($params['receipt_complement'] === FALSE) 
				{
					$this->error(__LINE__, sprintf('Iconv failed to convert encoding of receipt_complement from %s to %s', $fromCharset, $toCharset), 3);
					unset($params['receipt_complement']);
				} else {
					$rawReceipt = $params['receipt_complement'];
					$params['receipt_complement'] = '';
					//Now we convert all non ASCII 128 character to an HTML entity as ATOS SIPS API is really old
					// and seems to have problem with these characters. It's a waste of character, but it was my better idea
					// to deal with it
					for ($c = 0; $c < strlen($rawReceipt); $c++)
						if (ord($rawReceipt[$c]) <= 128)
							$params['receipt_complement'] .= $rawReceipt[$c];
						else
							$params['receipt_complement'] .= '&#'.ord($rawReceipt[$c]).';';
					if (strlen($params['receipt_complement']) > self::RECEIPT_COMPLEMENT_MAXLENGTH) {
						$this->error(__LINE__, sprintf('Receipt complement is too long: %u characters long, %u characters max.', strlen($params['receipt_complement']), self::RECEIPT_COMPLEMENT_MAXLENGTH), 3, $params['receipt_complement']);
						unset($params['receipt_complement']);
					}
				}
			} else {
				unset($params['receipt_complement']);
			}
		}
		$params['amount'] = str_pad((string)$params['amount'], 3, '0', STR_PAD_LEFT);
		$call = $this->rawCall(self::BIN_REQUEST, $this->paramsToArgs($params));
		if ($call->exit_code != 0)
		{
			$this->error(__LINE__, sprintf('Error when calling request ATOS binary, exit code was: '.$call->exit_code), 4, $call);
			return false;
		}
		$result = new TggAtosModuleRequestOutputParser($call);
		if (!$result->success)
		{
			$this->error(__LINE__, 'Atos invocation returned an error: '.$call->command, 4, $result);
			return false;
		}
		return ($this->get(self::CNF_DEBUG_MODE) && !empty($result->error)) ? $result->error : $result->form;
	}
	
	/**
	 * Uncypher bank response using ATOS SIPS response binary
	 * @param string $message
	 * @return boolean|TggAtosModuleResponseObject
	 */
	public function uncypherResponse($message, $responseType)
	{
		$params = array(
			'pathfile' => $this->get(self::CNF_PARAM_PATH).self::PATHFILE,
			'message' => $message
		);
		$call = $this->rawCall(self::BIN_RESPONSE, $this->paramsToArgs($params));
		if ($call->exit_code != 0)
		{
			$this->error(__LINE__, sprintf('Error when calling response ATOS binary, exit code was: %u', $call->exit_code), 4, $call);
			return false;
		}
		$result = new TggAtosModuleResponseOutputParser($call, $message, $responseType, $this);
		if (!$result->success)
		{
			$this->error(__LINE__, 'Failure to uncypher bank response '.$message, 4, $result);
			return false;
		}
		return $result->response;
	}
	
	/**
	 * @param TggAtosModuleResponseObject $response
	 * @return Order
	 */
	
	public function processResponse(TggAtosModuleResponseObject $response)
	{
		if (is_null($response))
			throw new InvalidArgumentException('$response must be not null');
		$this->logResponse($response);
		$this->context->cart = new Cart(intval($response->order_id));
		if (!Validate::isLoadedObject($this->context->cart))
			throw new PrestaShopModuleException('Payment cart cannot be loaded');
		if (is_null($this->context->link))
			$this->context->link = new Link();
		if ($this->context->cart->orderExists())
		{
			return new Order(Order::getOrderByCartId($this->context->cart->id));
		} else {
			$this->context->currency = Currency::getCurrencyInstance(Currency::getIdByIsoCodeNum($response->currency_code));
			if (!Validate::isLoadedObject($this->context->currency))
				throw new PrestaShopModuleException('Payment currency cannot be loaded');
			if ($response->capture_mode == 'PAYMENT_N')
			{
				switch ($response->getDataVar('NB_PAYMENT'))
				{
					case 2:
						$mode = self::MODE_2TPAYMENT;
					case 3:
						$mode = self::MODE_3TPAYMENT;
				}
				/* We have to reserve the transaction_id for automatic payments */
				$timezone = new DateTimeZone($this->get(self::CNF_TID_TZ));
				$paymentDate = DateTime::createFromFormat('Ymd', $response->payment_date, $timezone);
				$period = new DateInterval(sprintf('P%uD', intval($response->getDataVar('PERIOD'))));
				for ($pn = 1; $pn < $response->getDataVar('NB_PAYMENT'); $pn++)
				{
					$paymentDate->add($period);
					$this->reserveTransactionId(DB::getInstance(), $paymentDate, $response->transaction_id, false, true);
				}
			} else {
				$mode = self::MODE_SINGLE;
			}
			switch ($response->response_code)
			{
				case '00':
					switch ($mode)
					{
						case self::MODE_SINGLE:
							$orderState = $this->get(self::CNF_OS_PAYMENT_SUCCESS);
							break;
						case self::MODE_2TPAYMENT:
							$orderState = $this->get(self::CNF_2TPAYMENT_OS);
							break;
						case self::MODE_3TPAYMENT:
							$orderState = $this->get(self::CNF_3TPAYMENT_OS);
							break;
					}
					break;
				case '17':
					$orderState = $this->get(self::CNF_OS_PAYMENT_CANCELLED);
					break;
				default:
					$orderState = $this->get(self::CNF_OS_PAYMENT_FAILED);
					break;
			}
			if (!$orderState)
				return NULL;
			$amount = $response->amount;
			if ($this->context->currency->decimals)
				$amount /= 100;
			$extraVars = array();
			$orderLog = $this->get(self::CNF_ORDER_MESSAGE) ? array() : null;
			foreach (TggAtosModuleResponseObject::$fields as $field)
			{
				$extraVars['tggatos_'.$field] = $response->{$field};
				if (is_array($orderLog)) $orderLog[] = $field.': '.$response->{$field};
			}
			$extraVars['transaction_id'] = $response->{$this->get(self::CNF_OP_FIELD_TID)};
			$this->validateOrder(
				$this->context->cart->id,
				$orderState,
				$amount - $this->getPaymentFees($amount, $this->context->currency, $mode),
				$this->displayName,
				implode(PHP_EOL, $orderLog),
				$extraVars,
				$this->context->currency->id,
				false,
				$this->context->cart->secure_key
			);
			$order = new Order($this->currentOrder);
			$orderPayments = OrderPayment::getByOrderReference($order->reference);
			if (is_array($orderPayments) && count($orderPayments) == 1)
			{
				$orderPayment = array_shift($orderPayments);
				/* @var $orderPayment OrderPayment */
				$orderPayment->payment_method = $this->displayName;
				$orderPayment->id_currency = $this->context->currency->id;
				$orderPayment->conversion_rate = $this->context->currency->conversion_rate;
				$orderPayment->card_brand = $response->payment_means;
				$orderPayment->card_number = str_replace('.', ' #### #### ##', $response->card_number);
				if ($response->capture_mode == 'PAYMENT_N')
				{
					$orderPayment->payment_method .= ' x'.$response->getDataVar('NB_PAYMENT');
				}
				$orderPayment->save();
			}
			return $order;
		}
	}
	
	/**
	 * @var Currency
	 */
	protected $_defaultCurrency = null;
	public function getDefaultCurrency()
	{
		if (is_null($this->_defaultCurrency))
			$this->_defaultCurrency = Currency::getDefaultCurrency();
		return $this->_defaultCurrency;
	}
	
	/**
	 * @param float $amount
	 * @param Currency|int $currency
	 * @param int $direction self::CONVERT_*
	 * @throws PrestaShopModuleException
	 * @return float
	 */
	public function defaultCurrencyConvert($amount, $currency, $direction)
	{
		if (is_numeric($currency))
			$currency = Currency::getCurrencyInstance(intval($currency));
		if (!Validate::isLoadedObject($currency))
			throw new PrestaShopModuleException('Argument $currency must be a Currency object or a valid currency ID');
		$amount = floatval($amount);
		if ($this->getDefaultCurrency()->conversion_rate != $currency->conversion_rate)
			switch ($direction) 
			{
				case self::CONVERT_TO_DEFAULT:
					$amount *= floatval($this->getDefaultCurrency()->conversion_rate) / floatval($currency->conversion_rate);
					break;
				case self::CONVERT_FROM_DEFAULT:
					$amount /= floatval($this->getDefaultCurrency()->conversion_rate) / floatval($currency->conversion_rate);
					break;
				default:
					throw new PrestaShopModuleException('Invalid Argument $direction (must be self::CONVERT_*)');
			}
		return $amount;
	}
		
	/**
	 * @param int $mode self::MODE_*
	 * @throws PrestaShopModuleException
	 * @return float
	 */
	public function getMinAmount($mode)
	{
		switch ($mode)
		{
			case self::MODE_SINGLE:
				return $this->get(self::CNF_MINAMOUNT);
			case self::MODE_2TPAYMENT:
				return $this->get(self::CNF_2TPAYMENT_MINAMOUNT);
			case self::MODE_3TPAYMENT:
				return $this->get(self::CNF_3TPAYMENT_MINAMOUNT);
			default:
				throw new PrestaShopModuleException('Invalid Argument $mode (must be self::MODE_*)');
		}
	}
	
	public function getPaymentFees($amount, Currency $currency, $mode)
	{
		$fixed = null;
		$percent = null;
		switch ($mode)
		{
			case self::MODE_SINGLE:
				$fixed = $this->get(self::CNF_PAYMENT_FEES);
				$percent = $this->get(self::CNF_PAYMENT_FEES_P);
				break;
			case self::MODE_2TPAYMENT:
				$fixed = $this->get(self::CNF_2TPAYMENT_FEES);
				$percent = $this->get(self::CNF_2TPAYMENT_FEES_P);
				break;
			case self::MODE_3TPAYMENT:
				$fixed = $this->get(self::CNF_3TPAYMENT_FEES);
				$percent = $this->get(self::CNF_3TPAYMENT_FEES_P);
				break;
			default:
				throw new PrestaShopModuleException('Invalid Argument $mode (must be self::MODE_*)');
		}
		return Tools::ps_round($this->defaultCurrencyConvert($fixed, $currency, self::CONVERT_FROM_DEFAULT) + $percent / 100 * $amount, $currency->decimals ? 2 : 0);
	}
	
	public function getBankReturnUri($context)
	{
		switch ($context)
		{
			case self::RETURN_CONTEXT_USER:
				$protocol = $this->get(self::CNF_RETURN_PROTOCOL_USER);
				$domain = $this->get(self::CNF_RETURN_DOMAIN_USER);
				$controller = $this->getPathUri().self::BANK_CONTROLLER_USER;
				break;
			case self::RETURN_CONTEXT_SILENT:
				$protocol = self::RETURN_PROTOCOL_HTTP;
				$domain = $this->get(self::CNF_RETURN_DOMAIN_SILENT);
				$controller = preg_replace('@^(https?://[^/]+)?(/.*)$@', '$2', $this->context->link->getModuleLink($this->name, 'silentresponse'));
				break;
			default:
				throw new PrestaShopModuleException('Invalid Argument $context (must be self::RETURN_CONTEXT_*)');
		}
		if ($protocol == self::RETURN_PROTOCOL_AUTO)
		{
			$protocol = Configuration::get('PS_SSL_ENABLED') ? self::RETURN_PROTOCOL_HTTPS : self::RETURN_PROTOCOL_HTTP;
		}
		if ($domain == self::RETURN_DOMAIN_AUTO)
		{
			$domain = ($protocol == self::RETURN_PROTOCOL_HTTPS) ? Tools::getShopDomainSsl(false) : Tools::getShopDomain(false);
		}
		return $protocol.$domain.$controller;
	}
	
	/**
	 * @return boolean|string
	 */
	public function generateTransactionId()
	{
		$DB = Db::getInstance(true);
		$timezoneStr = $this->get(self::CNF_TID_TZ);
		if (empty($timezoneStr))
		{
			$timezoneStr = 'UTC';
		}
		$timezone = new DateTimeZone($timezoneStr);
		$yesterday = new DateTime('-1 day', $timezone);
		//We don't clean yesterday's records to avoid clustering problems with bad time sync arround midnight
		$DB->delete($this->getTable(self::TABLE_TRANSACTION_TODAY, false), '`date` < \''.$yesterday->format('Y-m-d').'\'');
		$now = new DateTime('now', $timezone);
		$tid = $this->reserveTransactionId($DB, $now);
		if ($tid < $this->get(self::CNF_MIN_TID))
		{
			$this->reserveTransactionId($DB, $now, $this->get(self::CNF_MIN_TID) - 1, false, true);
			$tid = $this->reserveTransactionId($DB, $now);
		}
		if ($tid > $this->get(self::CNF_MAX_TID))
			return false;
		return $tid;
	}
	
	/**
	 * @param Db $DB
	 * @param DateTime $date
	 * @param int|null $id Set to null to autogenerate
	 * @param bool $throwException Wether an expect should be thrown on failure
	 * @param bool $ignoreDuplicate Wether an ID reservation duplicate should be handled as an error
	 * @throws PrestaShopDatabaseException
	 * @return string
	 */
	public function reserveTransactionId(Db $DB, DateTime $date, $id = null, $throwException = true, $ignoreDuplicate = false)
	{
		$data = array('date' => $date->format('Y-m-d'));
		if (!is_null($id)) {
			$data['transaction_id'] = $id;
		}
		if (!$DB->insert($this->getTable(self::TABLE_TRANSACTION_TODAY, false), $data, false, false, $ignoreDuplicate ? Db::INSERT_IGNORE : Db::INSERT)) {
			if ($throwException) {
				throw new PrestaShopDatabaseException();
			}
			return null;
		}
		return $DB->Insert_ID();
	}
	
	/**
	 * Populate internal configuration definition
	 */
	protected function initConfVars()
	{
		if (!empty($this->_confVars)) return;
		$comment = 0;
		$this->_confVars = array(
			'INTERNAL' => array(
				self::CNF_VERSION => array(
					'type' => self::T_STRING,
					'input' => self::IN_INTERNAL,
					'default' => '0'
				),
			),
			'BASIC' => array(
				self::CNF_BANK => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('Your bank'),
					'atos' => 'merchant_id',
					'pathfile' => 'F_DEFAULT',
					'values' => $this->_banks,
					'default' => ''
				),
				self::CNF_PRODUCTION => array(
					'type' => self::T_BOOL,
					'input' => self::IN_SELECT,
					'description' => $this->l('ATOS Run mode'),
					'atos' => 'merchant_id',
					'values' => array(
						FALSE => $this->l('Demonstration: Use your bank\'s demo certificate'),
						TRUE => $this->l('(Pre-)Production: Use your production certificate')
					),
					'default' => FALSE
				),
				self::CNF_MERCHANT_ID => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'template' => 'merchant_id',
					'description' => $this->l('Select the production certificate (unused in demonstration mode)'),
					'hint' => Tools::htmlentitiesDecodeUTF8(sprintf($this->l('Your production certificate must be uploaded to "%s" defined in advanced configuration, named certif.fr.xxxxxxxxxxxxxxx where xxxxxxxxxxxxxxx is your merchant ID, this file has to be read/write protected, only PHP and you should be able to read it, and only you should be able to modify it.'), $this->l('Location of ATOS configuration'))),
					'atos' => 'merchant_id',
					'values' => new TggAtosModuleFunctionCall('getMerchantIdList', array(TRUE)),
					'default' => ''
				),
				self::CNF_ISO_LANG => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Force a language in payment server'),
					'hint' => $this->l('If none given, ISO code of the language used by client to browse your shop will be sent to ATOS API. See ATOS doc. for available language codes.'),
					'atos' => 'language',
					'default' => ''
				),
				self::CNF_RESPONSE_LOG_TXT => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Log bank responses in human readable format'),
					'default' => TRUE
				),
				self::CNF_RESPONSE_LOG_CSV => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Log bank responses in CSV format (currently needed to display payment information on user return).'),
					'default' => TRUE
				),
				self::CNF_LOG_PATH => array(
					'type' => self::T_PATH,
					'input' => self::IN_TEXT,
					'description' => $this->l('Responses logs storage path'),
					'hint' => $this->l('MUST only be accessible to you and PHP user. MUST be writable by PHP user.'),
					'width' => '100%',
					'default' => $this->local_path . 'log'.DIRECTORY_SEPARATOR
				),
				self::CNF_ORDER_MESSAGE => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Add a summary of the transaction as order message'),
					'hint' => $this->l('Only visible by back office users.'),
					'default' => TRUE
				),
				self::CNF_CHECK_VERSION => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Check availabity of update in back office (see hint for confidentialities issues)'),
					'hint' => $this->l('May slow a bit modules page on back office and may not work on some low cost hostings.|In exchange of this service, statistics are collected, following information will be transmitted:|- PrestaSop\'s version|- TggAtos\'s version|- Shop domain|- Back-office language used'),
					'default' => FALSE
				),
				self::CNF_OS_PAYMENT_CANCELLED => array(
					'type' => self::T_UNSIGNED_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Order state to apply on cancel return'),
					'values' => TggAtosModuleFunctionCall::factory('getOrderStatesSelectArray', array($this->l('No order creation'))),
					'default' => 0
				),
				self::CNF_OS_PAYMENT_FAILED => array(
					'type' => self::T_UNSIGNED_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Order state to apply on payment fail return'),
					'values' => TggAtosModuleFunctionCall::factory('getOrderStatesSelectArray', array($this->l('No order creation'))),
					'default' => 0
				),
			),
			'SINGLE' => array(
				self::CNF_SINGLE => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Enable single payment mode'),
					'default' => FALSE
				),
				self::CNF_PAYMENT_MEANS => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Accepted payment means'),
					'atos' => 'payment_means',
					'width' => '100%',
					'default' => 'CB,3,VISA,3,MASTERCARD,3'
				),
				self::CNF_MINAMOUNT => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Disable this payment method when cart amount is below this value'),
					'default' => 0.0
				),
				self::CNF_CAPTURE_MODE => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('Select capture mode to apply'),
					'hint' => $this->l('See ATOS doc. about capture mode.'),
					'atos' => 'capture_mode',
					'values' => array(
						'AUTHOR_CAPTURE' => 'AUTHOR_CAPTURE',
						'VALIDATION' => 'VALIDATION'
					),
					'default' => 'AUTHOR_CAPTURE'
				),
				self::CNF_CAPTURE_DAY => array(
					'type' => self::T_UNSIGNED_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Select capture delay'),
					'hint' => $this->l('See ATOS doc. about capture mode.'),
					'atos' => 'capture_day',
					'values' => range(0,99),
					'default' => 0
				),
				self::CNF_OS_PAYMENT_SUCCESS => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Select order state to apply on a successful payment'),
					'values' => TggAtosModuleFunctionCall::factory('getOrderStatesSelectArray'),
					'default' => Configuration::get('PS_OS_PAYMENT')
				),
				self::CNF_PAYMENT_FEES => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fixed payment fees'),
					'hint' => $this->l('This value is related to the selected default currency.'),
					'default' => 0.0
				),
				self::CNF_PAYMENT_FEES_P => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fees relative to cart amount'),
					'hint' => $this->l('Expressed in cart amount percent. Added to fixed fees.'),
					'field_suffix' => '%',
					'default' => 0.0
				),
			),
			'2TIMES' => array(
				self::CNF_2TPAYMENT => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Enable 2 times payments mode'),
					'default' => FALSE
				),
				self::CNF_2TPAYMENT_MEANS => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Accepted payment means'),
					'atos' => 'payment_means',
					'width' => '100%',
					'default' => 'CB,3,VISA,3,MASTERCARD,3'
				),
				self::CNF_2TPAYMENT_MINAMOUNT => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Minimum cart amount to use 2 times payments'),
					'default' => 0.0
				),
				self::CNF_2TPAYMENT_DELAY => array(
					'type' => self::T_UNSIGNED_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Days before first payment'),
					'atos' => 'capture_day',
					'values' => range(0,99),
					'default' => 0
				),
				self::CNF_2TPAYMENT_SPACING => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Days between the payments'),
					'atos' => 'data[PERIOD]',
					'values' => $this->_mirrorArray(range(1,30)),
					'default' => 30
				),
				self::CNF_2TPAYMENT_OS => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Order state to apply'),
					'values' => TggAtosModuleFunctionCall::factory('getOrderStatesSelectArray'),
					'default' => Configuration::get('PS_OS_PAYMENT')
				),
				self::CNF_2TPAYMENT_FEES => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fixed fees'),
					'default' => 0.0
				),
				self::CNF_2TPAYMENT_FEES_P => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fees relative to cart amount'),
					'hint' => $this->l('Added to fixed fees.'),
					'field_suffix' => '%',
					'default' => 0.0
				),
				self::CNF_2TPAYMENT_FP_FXD => array(
					'type' => self::T_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('First payment fixed amount'),
					'atos' => 'data[INITIAL_AMOUNT]',
					'default' => 0.0
				),
				self::CNF_2TPAYMENT_FP_PCT => array(
					'type' => self::T_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('First payment amount relative to cart amount'),
					'hint' => $this->l('Added to fixed amount.'),
					'field_suffix' => '%',
					'atos' => 'data[INITIAL_AMOUNT]',
					'default' => 50.0
				),
			),
			'3TIMES' => array(
				self::CNF_3TPAYMENT => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Enable 3 times payments mode'),
					'default' => FALSE
				),
				self::CNF_3TPAYMENT_MEANS => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Accepted payment means'),
					'atos' => 'payment_means',
					'width' => '100%',
					'default' => 'CB,3,VISA,3,MASTERCARD,3'
				),
				self::CNF_3TPAYMENT_MINAMOUNT => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Minimum cart amount to use 3 times payments'),
					'default' => 0.0
				),
				self::CNF_3TPAYMENT_DELAY => array(
					'type' => self::T_UNSIGNED_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Days before first payment'),
					'values' => range(0,99),
					'atos' => 'capture_day',
					'default' => 0
				),
				self::CNF_3TPAYMENT_SPACING => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Days between the payments'),
					'values' => $this->_mirrorArray(range(1,30)),
					'atos' => 'data[PERIOD]',
					'default' => 30
				),
				self::CNF_3TPAYMENT_OS => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_SELECT,
					'description' => $this->l('Order state to apply'),
					'values' => TggAtosModuleFunctionCall::factory('getOrderStatesSelectArray'),
					'default' => Configuration::get('PS_OS_PAYMENT')
				),
				self::CNF_3TPAYMENT_FEES => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fixed fees'),
					'default' => 0.0
				),
				self::CNF_3TPAYMENT_FEES_P => array(
					'type' => self::T_UNSIGNED_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Apply fees relative to cart amount'),
					'hint' => $this->l('Added to fixed fees.'),
					'field_suffix' => '%',
					'default' => 0.0
				),
				self::CNF_3TPAYMENT_FP_FXD => array(
					'type' => self::T_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('First payment fixed amount'),
					'atos' => 'data[INITIAL_AMOUNT]',
					'default' => 0.0
				),
				self::CNF_3TPAYMENT_FP_PCT => array(
					'type' => self::T_FLOAT,
					'input' => self::IN_TEXT,
					'description' => $this->l('First payment amount relative to cart amount'),
					'hint' => $this->l('Added to fixed amount.'),
					'field_suffix' => '%',
					'atos' => 'data[INITIAL_AMOUNT]',
					'default' => 33.4
				),
			),
			'GRAPHIC' => array(
				'comment'.($comment++) => array(
					'type' => self::T_NONE,
					'input' => self::T_NONE,
					'text' => $this->l('Following options are applied to the form redirecting to bank server (the clickable card logos). See ATOS pages customisation doc.')
				),
				self::CNF_CARD_IMG_PATH => array(
					'type' => self::T_URI,
					'input' => self::IN_TEXT,
					'description' => $this->l('Web URI of the folder containing card logos'),
					'hint' => $this->l('Change this to use a custom card logos pack. You should put your logos in a theme sub-folder. An undocumented limitation of PATHFILE reader seems to limit this field to 78 characters.'),
					'pathfile' => 'D_LOGO',
					'width' => '100%',
					'default' => $this->_path . 'images/card_logo/'
				),
				self::CNF_BLOCK_ORDER => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Block order'),
					'atos' => 'block_order',
					'parmcom' => 'BLOCK_ORDER',
					'default' => '1,2,3,4,5,6,7,8'
				),
				self::CNF_BLOCK_ALIGN => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('Block alignement'),
					'atos' => 'block_align',
					'parmcom' => 'BLOCK_ALIGN',
					'values' => array(
						self::BLOCK_ALIGN_LEFT => $this->l('Left'),
						self::BLOCK_ALIGN_CENTER => $this->l('Center'),
						self::BLOCK_ALIGN_RIGHT => $this->l('Right')
					),
					'default' => self::BLOCK_ALIGN_CENTER
				),
				self::CNF_HEADER_FLAG => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('Payment security comment'),
					'atos' => 'header_flag',
					'parmcom' => 'HEADER_FLAG',
					'values' => array(
						'yes' => $this->l('Yes'),
						'no' => $this->l('No')
					),
					'default' => 'yes'
				),
				self::CNF_TARGET => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Link to bank\'s page HTML target'),
					'atos' => 'target',
					'parmcom' => 'TARGET',
					'default' => ''
				),
				'comment'.($comment++) => array(
					'type' => self::T_NONE,
					'input' => self::T_NONE,
					'text' => $this->l('Following options are applied to the pages located on bank server. See ATOS pages customisation doc.')
				),
				self::CNF_TEMPLATE_FILE => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Stylesheet'),
					'atos' => 'templatefile',
					'parmcom' => 'TEMPLATE',
					'default' => ''
				),
				self::CNF_LOGO_LEFT => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Upper left logo'),
					'atos' => 'logo_id',
					'parmcom' => 'LOGO',
					'default' => ''
				),
				self::CNF_LOGO_CENTER => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Center banner'),
					'atos' => 'advert',
					'parmcom' => 'ADVERT',
					'default' => ''
				),
				self::CNF_LOGO_RIGHT => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Upper right logo'),
					'atos' => 'logo_id2',
					'parmcom' => 'LOGO2',
					'default' => 'merchant.gif'
				),
				self::CNF_LOGO_SUBMIT => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Submit logo'),
					'atos' => 'logo_id',
					'parmcom' => 'SUBMIT_LOGO',
					'default' => ''
				),
				self::CNF_LOGO_NORMAL_RETURN => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Normal return logo'),
					'atos' => 'normal_return_logo',
					'parmcom' => 'RETURN_LOGO',
					'default' => ''
				),
				self::CNF_LOGO_CANCEL_RETURN => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Cancel return logo'),
					'atos' => 'cancel_return_logo',
					'parmcom' => 'CANCEL_LOGO',
					'default' => ''
				),
				self::CNF_BG_IMAGE => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('HTML Background image'),
					'atos' => 'background_id',
					'parmcom' => 'BACKGROUND',
					'default' => ''
				),
				self::CNF_BG_COLOR => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('HTML Background RGB color'),
					'atos' => 'bgcolor',
					'parmcom' => 'BGCOLOR',
					'default' => ''
				),
				self::CNF_TXT_FONT => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('HTML Text font'),
					'atos' => 'textfont',
					'parmcom' => 'TEXTCOLOR',
					'default' => ''
				),
				self::CNF_TXT_COLOR => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('HTML Text RGB color'),
					'atos' => 'textcolor',
					'parmcom' => 'TEXTCOLOR',
					'default' => ''
				)
			),
			'ADVANCED' => array(
				self::CNF_FORCE_RETURN => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Force user return from bank'),
					'hint' => $this->l('Disables transaction summary on bank server, see NO_RESPONSE_PAGE data param in ATOS doc.'),
					'atos' => 'data[NO_RESPONSE_PAGE]',
					'default' => FALSE
				),
				self::CNF_SKIP_REDIRECTION_CONTROLLER => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Display redirection forms on displayPayment hook (see warnings in hint)'),
					'hint' => $this->l('WARNING: ATOS SIPS forms contain all payment parameters that will be transmitted to payment server. It means that they have to be refreshed if cart amount is updated. For exemple, using this feature in One Page Checkout mode will require some changes on your theme\'s javascript to refresh payment selection on each cart update. It will also consume a transaction ID on each forms display (all forms generated together use the same transaction ID to avoid wasting a lot of them). You will also want to customize tggatos/views/templates/hook/direct_payment.tpl'),
					'default' => FALSE
				),
				self::CNF_NO_TID_GENERATION => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Don\'t generate transaction ID'),
					'hint' => $this->l('ATOS API will be called without transaction ID, meaning that it will be set to HHMMSS according to server\'s time when calling ATOS API, which can cause a lot of problems (less transactions possible per days, possible collisions between clients, much less safe than segmenting available IDs between websites when using single certificate on multiple websites).'),
					'atos' => 'transaction_id',
					'default' => FALSE
				),
				self::CNF_TID_TZ => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('transaction_id time zone'),
					'hint' => Tools::htmlentitiesDecodeUTF8(sprintf($this->l('Allows to sync transaction_id sequence resetting with SIPS servers midnight. Ask you SIPS support what you should select here. Unused if option "%s" is checked.'), $this->l('Don\'t generate transaction ID'))),
					'atos' => 'transaction_id',
					'values' => TggAtosModuleFunctionCall::factory('getTimeZonesArraySelect'),
					'default' => FALSE,
				),
				self::CNF_MIN_TID => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Minimum transaction ID to use'),
					'hint' => Tools::htmlentitiesDecodeUTF8(sprintf($this->l('Between 1 and 999999. Unused if option "%s" is checked.'), $this->l('Don\'t generate transaction ID'))),
					'atos' => 'transaction_id',
					'default' => 1
				),
				self::CNF_MAX_TID => array(
					'type' => self::T_ABS_POSITIVE_INT,
					'input' => self::IN_TEXT,
					'description' => $this->l('Maximum transaction ID to use'),
					'hint' => Tools::htmlentitiesDecodeUTF8(sprintf($this->l('Between 1 and 999999. Unused if option "%s" is checked.'), $this->l('Don\'t generate transaction ID'))),
					'atos' => 'transaction_id',
					'default' => 999999
				),
				self::CNF_OP_FIELD_TID => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('ATOS Response field to use as PrestaShop\'s transaction ID in order payment'),
					'values' => $this->_mirrorArray(array(
						self::ATOS_FIELD_TRANSACTION_ID,
						self::ATOS_FIELD_PAYMENT_CERTIFICATE,
						self::ATOS_FIELD_AUTHORISATION_ID
					)),
					'default' => self::ATOS_FIELD_TRANSACTION_ID
				),
				self::CNF_BINARIES_IN_PATH => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Call binaries without path'),
					'hint' => $this->l('Check it if (and ONLY if) the location of the ATOS binaries to use is a folder of the PATH system var.'),
					'default' => FALSE
				),
				self::CNF_BIN_PATH => array(
					'type' => self::T_PATH,
					'input' => self::IN_TEXT,
					'description' => $this->l('Location of ATOS binaries'),
					'hint' => $this->l('Unused if the option above is enabled. PHP user MUST be able to CD to this dir.'),
					'width' => '100%',
					'default' => $this->local_path . 'bin'.DIRECTORY_SEPARATOR
				),
				self::CNF_BIN_SUFFIX => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Optionnal suffix to append at the end of request and response binaries before calling them.'),
					'default' => ''
				),
				self::CNF_PARAM_PATH => array(
					'type' => self::T_PATH,
					'input' => self::IN_TEXT,
					'description' => $this->l('Location of ATOS configuration'),
					'hint' => $this->l('MUST be readable (and writable to allow module to update those files) by PHP user.'),
					'pathfile' => 'F_PARAM, F_CERTIFICATE, F_DEFAULT',
					'width' => '100%',
					'default' => $this->local_path . 'param'.DIRECTORY_SEPARATOR
				),
				self::CNF_RETURN_PROTOCOL_USER => array(
					'type' => self::T_STRING,
					'input' => self::IN_SELECT,
					'description' => $this->l('User return protocol'),
					'hint' => $this->l('Used to generate the user return URL transmitted to ATOS API. Automatic means HTTPS will be used when, and only when, PS_SSL_ENABLED configuration is ON.'),
					'atos' => 'normal_return_url, cancel_return_url',
					'values' => array(
						self::RETURN_PROTOCOL_AUTO => $this->l('automatic'),
						self::RETURN_PROTOCOL_HTTP => self::RETURN_PROTOCOL_HTTP,
						self::RETURN_PROTOCOL_HTTPS => self::RETURN_PROTOCOL_HTTPS
					),
					'default' => self::RETURN_PROTOCOL_AUTO
				),
				self::CNF_RETURN_DOMAIN_USER => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('User return front office domain'),
					'hint' => $this->l('Used to generate the user return URL transmitted to ATOS API. Leave empty to use Prestashop\'s Shop domain.'),
					'atos' => 'normal_return_url, cancel_return_url',
					'width' => '100%',
					'default' => TggATos::RETURN_DOMAIN_AUTO
				),
				self::CNF_RETURN_DOMAIN_SILENT => array(
					'type' => self::T_STRING,
					'input' => self::IN_TEXT,
					'description' => $this->l('Silent return front office domain'),
					'hint' => $this->l('Used to generate the silent return URL transmitted to ATOS API. Leave empty to use Prestashop\'s Shop domain.'),
					'atos' => 'automatic_reponse_url',
					'width' => '100%',
					'default' => TggATos::RETURN_DOMAIN_AUTO
				),
				self::CNF_DEBUG_MODE => array(
					'type' => self::T_BOOL,
					'input' => self::IN_CHECKBOX,
					'description' => $this->l('Debug mode'),
					'pathfile' => 'DEBUG',
					'hint' => $this->l('Prints debug outputs alongside with payment redirection form. To allow internal module exceptions to be displayed too, set _PS_MODE_DEV_ Prestashop constant to TRUE in prestashop/config/defines.inc.php.'),
					'default' => FALSE
				),
			),
		);
		$this->_confVarsByName = array();
		foreach ($this->_confVars as $section)
			$this->_confVarsByName += $section;
	}
	
	/**
	 * Back office module's configuration page handler
	 * @return string Html configuration GUI
	 */
	public function getContent()
	{
		$this->initConfVars();
		$this->context->controller->addJqueryUI(array('ui.tabs'));
		foreach ($this->_confVars as $sectionName => $sectionVars)
			if (( $sectionName != 'INTERNAL' ) && Tools::isSubmit('btnSubmit'.$sectionName))
		{
			foreach ($sectionVars as $varname => $declaration)
			{
				if ($declaration['type'] == self::T_NONE) continue;
				if ($declaration['input'] == self::IN_INTERNAL) continue;
				if ($declaration['input'] == self::IN_NONE) continue;
				$this->set($varname, Tools::getValue('tggatos_'.$varname));
			}
			$this->updateAtosParamFiles();
		}
		$errorsIndex = $this->autoCheck();
		$html = '
		<h2>'.$this->displayName.'</h2>
		<h3>'.$this->l('by').' '.$this->author.'</h3>
		<style type="text/css" media="all">
			#tggatoscontent input[type="text"],
			#tggatoscontent select { display: block; box-sizing: border-box; }
			#tggatoscontent .atosref { display: inline-block; padding: 0.15em 0.4em 0.15em 0.15em; margin: 0.3em 0.15em; border: 1px dashed #034d93; }
			#tggatoscontent th,
			#tggatoscontent td { padding: 0.8em; border-bottom: 1px solid #ccc; }
			#tggatoscontent th.comment { border-bottom: 1px solid #666; }
			.ui-tooltip { text-align: left; }
		</style>
		<script type="text/javascript">
			jQuery(function($) {
				$(\'#tggatosconfigtabs\').tabs({ active: '.intval(Tools::getValue('tggatos_opennedPannel', 0)).' });
			});
		</script>
		<div id="tggatoscontent">
		';
		if (!empty($this->_errors))
		{
			$html .= '
			<ol class="errors">
			';
			foreach ($this->_errors as $error)
			{
				$html .= '
				<li class="error">'.nl2br(Tools::htmlentitiesUTF8($error)).'</li>
				';
			}
			$html .= '
			</ol>
			';
		}
		$errorLog = $this->get(self::CNF_LOG_PATH) . self::FILE_ERROR_LOG;
		if (file_exists($errorLog))
		{
			$html .= '<h4>' . $this->l('Error log') . ' <small>' . Tools::htmlentitiesUTF8($errorLog) . '</small></h4>
			<p style="white-space: pre-wrap; border: 1px solid red; padding: 1em;">' . preg_replace('/^(\|\+&gt; [0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}:)/m', '<br /><strong style="font-size: larger;">$1</strong>', Tools::htmlentitiesUTF8(file_get_contents($errorLog))) . '</p>
			';
		}
		$html .= '
			<p>'.$this->l('Many options have additionnal information displayed by hovering corresponding input field with your mouse cursor.').'</p>
			<div id="tggatosconfigtabs">
				<ul class="clearfix">
		';
		foreach ($this->_confVars as $sectionName => $sectionVars)
		{
			if ($sectionName == 'INTERNAL') continue;
			$html .= '
					<li><a href="#tggatostab'.$sectionName.'">'.Tools::htmlentitiesUTF8($this->l($sectionName)).( $errorsIndex[$sectionName] ? ' '.sprintf($this->l('%u warning(s)'), $errorsIndex[$sectionName]) : '' ).'</a></li>
			';
		}
		$html .= '
				</ul>
		';
		$panel = 0;
		foreach ($this->_confVars as $sectionName => $sectionVars)
		{
			if ($sectionName == 'INTERNAL') continue;
			$html .= '
				<form action="'.Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']).'" method="post" id="tggatostab'.$sectionName.'">
					<fieldset>
						<legend>'.Tools::htmlentitiesUTF8($this->l($sectionName)).'</legend>
						<input type="hidden" name="tggatos_opennedPannel" value="'.($panel++).'" />	
						<table border="0" cellpadding="0" cellspacing="0" id="form" style="width: 100%;" class="tggatos">
			';
			foreach ($sectionVars as $name => $declaration)
			{
				if ($declaration['input'] == self::IN_INTERNAL) continue;
				ob_start();
				if ($declaration['input'] == self::IN_NONE)
				{
					$html .= '
							<tr>
								<th colspan="2" class="comment">
									<p>'.Tools::htmlentitiesUTF8($declaration['text']).'</p>
								</th>
							</tr>
					';
				}
				else 
				{
					$html .= '
							<tr>
								<th width="250" style="vertical-align: top; text-align: right; padding-right: 1em;">
									<label for="tggatos_conffield_'.Tools::htmlentitiesUTF8($name).'">'.preg_replace('/\([^)]+\)/', '<span style="font-size: smaller;">$0</span>', Tools::htmlentitiesUTF8($declaration['description'])).'</label>
					';
					$html .= '
									</th>
									<td style="padding-bottom:15px;">
					';
					$styles = array();
					if (!empty($declaration['field_suffix']))
						array_push($styles, 'display: inline-block;');
					if (!empty($declaration['width']))
						array_push($styles, 'width: '.$declaration['width'].';');
					$styles = implode(' ', $styles);
					switch ($declaration['input'])
					{
						case self::IN_NONE:
							break;
						case self::IN_TEXT:
							$html .= '
									<input type="text" name="tggatos_'.Tools::htmlentitiesUTF8($name).'" id="tggatos_conffield_'.Tools::htmlentitiesUTF8($name).'" value="'.Tools::htmlentitiesUTF8($this->get($name)).'" style="'.$styles.'" />
							';
							break;
						case self::IN_SELECT:
							if ($declaration['values'] instanceof TggAtosModuleDynamicValue)
								$declaration['values'] = $declaration['values']->getValue($this);
							$html .= '
									<select name="tggatos_'.Tools::htmlentitiesUTF8($name).'" id="tggatos_conffield_'.Tools::htmlentitiesUTF8($name).'" style="'.$styles.'">
							';
							foreach ($declaration['values'] as $value => $display)
							{
								$html .= '
										<option value="'.Tools::htmlentitiesUTF8($value).'"'.( $this->get($name) == $value ? ' selected="selected"' : '' ).'>'.Tools::htmlentitiesUTF8($display).'</option>
								';
							}
							$html .= '
									</select>
							';
							break;
						case self::IN_CHECKBOX:
							$html .= '
									<input type="hidden" name="tggatos_'.Tools::htmlentitiesUTF8($name).'" value="0" />
									<input type="checkbox" name="tggatos_'.Tools::htmlentitiesUTF8($name).'" id="tggatos_conffield_'.Tools::htmlentitiesUTF8($name).'" value="1"'.( $this->get($name) ? ' checked="checked"' : '' ).' style="'.$styles.'" />
							';
							break;
						default:
							$html .= 'ERROR UNKNOWN INPUT TYPE';
					}
					if (!empty($declaration['field_suffix']))
						$html .= Tools::htmlentitiesUTF8($declaration['field_suffix']);
					$html .= '
									<br />
					';
					if (!empty($declaration['hint']))
					{
						$html .= '
									<p class="hint">'.str_replace('|', '<br />', Tools::htmlentitiesUTF8($declaration['hint'])).'</p>
						';
					}
					if (!empty($declaration['atos']))
					{
						$html .= '
									<strong title="'.Tools::htmlentitiesUTF8($this->l('ATOS parameter, cf parameters glossary in ATOS doc.')).'" class="atosref"><img src="'.Tools::htmlentitiesUTF8($this->_path).'images/atos_icon.gif" width="16" height="16" />&nbsp;<em>'.$declaration['atos'].'</em></strong>
						';
					}
					if (!empty($declaration['pathfile']))
					{
						$html .= '
									<strong title="'.Tools::htmlentitiesUTF8($this->l('ATOS pathfile parameter, cf ATOS programmer\'s guide.')).'" class="atosref"><img src="'.Tools::htmlentitiesUTF8($this->_path).'images/atos_icon.gif" width="16" height="16" />&nbsp;pathfile: <em>'.$declaration['pathfile'].'</em></strong>
						';
					}
					if (!empty($declaration['parmcom']))
					{
						$html .= '
									<strong title="'.Tools::htmlentitiesUTF8($this->l('This value is written in parmcom file to following configuration entry')).'" class="atosref"><img src="'.Tools::htmlentitiesUTF8($this->_path).'images/atos_icon.gif" width="16" height="16" />&nbsp;parmcom: <em>'.$declaration['parmcom'].'</em></strong>
						';
					}
					$html .= '
								</td>
							</tr>
					';
				}
				$ob_local = ob_get_clean();
				if (!empty($ob_local))
					$html .= '<tr><td colspan="2">'.$ob_local.'</td></tr>';
			}
			$html .= '
							<tr><td colspan="2" align="center"><input class="button" name="btnSubmit'.$sectionName.'" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
						</table>
					</fieldset>
				</form>
			';
		}
		$html .= '
			</div>
		</div>
		';
		return $html;
	}
	
	public function generatePathfileContent()
	{
		return $pathfile_content = array(
			'DEBUG' => $this->get(self::CNF_DEBUG_MODE) ? 'YES' : 'NO',
			'D_LOGO' => $this->get(self::CNF_CARD_IMG_PATH),
			'F_CERTIFICATE' => $this->get(self::CNF_PARAM_PATH) . self::CERTIF,
			'F_PARAM' => $this->get(self::CNF_PARAM_PATH) . self::PARMCOM,
			'F_DEFAULT' => $this->get(self::CNF_PARAM_PATH) . self::PARMCOM . '.' . $this->get(self::CNF_BANK)
		);
	}
	
	public function updateAtosParamFiles()
	{
		if (!$this->get(self::CNF_BANK))
			return;
		if ($this->get(self::CNF_PRODUCTION) && !$this->get(self::CNF_MERCHANT_ID))
			return;
		$this->initConfVars();
		$pathfile_content = $this->generatePathfileContent();
		foreach ($pathfile_content as $name => &$line)
			$line = $name . '!' . $line . '!';
		$pathfile = $this->get(self::CNF_PARAM_PATH) . self::PATHFILE;
		$parmcom_content = array();
		foreach ($this->_confVarsByName as $name => $declaration)
			if (!empty($declaration['parmcom']) && $this->get($name))
				$parmcom_content[] = $declaration['parmcom'] . '!' . $this->get($name) . '!';
		$parmcom = $this->get(self::CNF_PARAM_PATH) . self::PARMCOM . '.' . ( $this->get(self::CNF_PRODUCTION) ? $this->get(self::CNF_MERCHANT_ID) : $this->_demoCertificates[$this->get(self::CNF_BANK)] );
		try {
			foreach (array($pathfile => $pathfile_content, $parmcom => $parmcom_content) as $file => $content)
			{
				array_unshift($content, '# Generated by module ' . $this->name . ' ' . $this->version . ' on Prestashop ' . _PS_VERSION_);
				if (!file_put_contents($file, implode(PHP_EOL, $content).PHP_EOL))
				{
					throw new Exception(sprintf($this->l('Unable to write to file %s'), $file));
				}
			}
		}
		catch (Exception $e)
		{
			$this->_errors[] = $e->getMessage();
		}
	}
	
	public function logResponse(TggAtosModuleResponseObject $response)
	{
		if ($this->get(self::CNF_RESPONSE_LOG_TXT))
		{
			try 
			{
				$file = $this->get(self::CNF_LOG_PATH).date('Y-m-d').'.log';
				$handle = fopen($file, 'a');
				if (!is_resource($handle))
					throw new PrestaShopModuleException('Unable to open file in append mode: '.$file);
				fwrite($handle, '----- '.date('Y-m-d H:i:s').PHP_EOL);
				foreach (array_merge(TggAtosModuleResponseObject::$fields, TggAtosModuleResponseObject::$additionnalLoggableFields) as $name)
					fwrite($handle, $name . ': ' . $response->{$name} . PHP_EOL);
				fwrite($handle, PHP_EOL);
				fclose($handle);
			} catch (Exception $e) {
				$this->error(__LINE__, $e->getMessage(), 3, NULL, false);
			}
		}
		if ($this->get(self::CNF_RESPONSE_LOG_CSV))
		{
			try 
			{
				$file = $this->get(self::CNF_LOG_PATH).date('Y-m-d').'.csv';
				$new = !file_exists($file);
				$handle = fopen($file, 'a');
				if (!is_resource($handle))
					throw new PrestaShopModuleException('Unable to open file in append mode: '.$file);
				if ($new)
				{
					$fields = array_merge(TggAtosModuleResponseObject::$fields, TggAtosModuleResponseObject::$additionnalLoggableFields);
					array_unshift($fields, 'log_date');
					fputcsv($handle, $fields, ';', '"');
				}
				$fields = array(date('Y-m-d H:i:s'));
				foreach (array_merge(TggAtosModuleResponseObject::$fields, TggAtosModuleResponseObject::$additionnalLoggableFields) as $name)
					array_push($fields, (string)$response->{$name});
				fputcsv($handle, $fields, ';', '"');
				fclose($handle);
			} catch (Exception $e) {
				$this->error(__LINE__, $e->getMessage(), 3, NULL, false);
			}
		}
	}
	
	/**
	 * @param string $date Y-m-d
	 * @param int $id_cart
	 * @return TggAtosModuleResponseObject
	 */
	public function getResponseFromLog($date, $id_cart, $transaction_id)
	{
		$file = $this->get(TggAtos::CNF_LOG_PATH).$date.'.csv';
		if (!file_exists($file)) return null;
		$found = 0;
		$response = null;
		$handle = fopen($file, 'r');
		if (!is_resource($handle))
			return null;
		try {
			$fields = fgetcsv($handle, null, ';', '"');
			if (!count($fields))
				throw new Exception('Unable to parse headers. File is either empty or corrupted.');
			$idCartColumn = array_search('order_id', $fields);
			if ($idCartColumn === FALSE)
				throw new Exception('No order_id column found.');
			$transactionIdColumn = array_search('transaction_id', $fields);
			if ($transactionIdColumn === FALSE)
				throw new Exception('No transaction_id column found.');
			while (!feof($handle) && ($line = fgetcsv($handle, null, ';', '"'))) {
				if (isset($line[$idCartColumn]) && $line[$idCartColumn] == $id_cart && isset($line[$transactionIdColumn]) && $line[$transactionIdColumn] == $transaction_id)
				{
					$fieldCount = count(array_filter($line));
					if ($fieldCount >= $found)
					{
						$found = $fieldCount;
						$response = $line;
					}
				}
			}
				
		} catch (Exception $e) {
			$this->error(__LINE__, 'Error while retrieving response from logs '.$file.': '.$e->getMessage(), 1, null, false, false, __FILE__);
		}
		fclose($handle);
		if ($found)
		{
			$response = TggAtosModuleResponseObject::hydrate(array_combine($fields,$response), $this);
		}
		return $response;
	}
	
	/**
	 * Resolve dynamic value from an object implementing TggAtosModuleDynamicValue
	 * Resolution is done internally rather than in descriptor class to allow access to protected or private property/function
	 * @param TggAtosModuleDynamicValue $dynamicDescriptor
	 * @return mixed value
	 */
	public function getDynamicValue(TggAtosModuleDynamicValue $dynamicDescriptor) 
	{
		if ($dynamicDescriptor instanceof TggAtosModuleProperty) {
			return $this->{$dynamicDescriptor->getPropertyName()};
		}
		if ($dynamicDescriptor instanceof TggAtosModuleFunctionCall) {
			return call_user_func_array(array($this, $dynamicDescriptor->getFunctionName()), $dynamicDescriptor->getParameters());
		}
		throw new PrestaShopModuleException('Unimplemented dynamic value descriptor '.(get_class($dynamicDescriptor)));
	}
	
	/**
	 * Get list of production certificates installed
	 * @param $prependEmptyLine Prepend an empty line to select
	 * @return array
	 */
	public function getMerchantIdList($prependEmptyLine = FALSE) 
	{
		$prefix = 'certif.fr.';
		$prefix_length = strlen($prefix);
		$path = $this->get(self::CNF_PARAM_PATH);
		if (!is_dir($path)) return FALSE;
		$oldPath = getcwd();
		chdir($path);
		$files = glob($prefix.str_repeat('?', 15));
		$codes = array();
		foreach ($files as $file) 
		{
			$code = substr($file, $prefix_length);
			if (preg_match('/^[0-9]{15}$/', $code)) 
			{
				if (in_array($code, $this->_demoCertificates)) continue;
				$info = '';
				try
				{
					$cert = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
					if (empty($cert)) throw new Exception('Unable to read file or file empty');
					$matches = null;
					while ($line = array_pop($cert))
					{
						if (preg_match('/^\+*(?P<info>[^+]+)\++$/', $line, $matches))
						{
							$info = $matches['info'];
							break;
						}
					}
					if (empty($info))
						throw new Exception('None found');
				}
				catch (Exception $e) 
				{ 
					$info = $this->l('Error reading certificate information: '.$e->__toString()); 
				}
				$codes[$code] = $code.' ('.$info.')';
			}
		}
		chdir($oldPath);
		if ($prependEmptyLine)
			return array(is_bool($prependEmptyLine) ? '' : $prependEmptyLine) + $codes;
		return $codes;
	}
	
	/**
	 * Several checks about module's health
	 * @return array Errors count
	 */
	public function autoCheck() 
	{
		if (!Module::isInstalled($this->name)) return;
		$this->initConfVars();
		$this->warning = array();
		$errorsIndex = array('BASIC' => 0, 'SINGLE' => 0, '2TIMES' => 0, '3TIMES' => 0, 'GRAPHIC' => 0, 'ADVANCED' => 0);
		if (version_compare($this->version, $this->get(self::CNF_VERSION), '>'))
			$this->postUpdate();
		$errorLogFile = $this->get(self::CNF_LOG_PATH) . self::FILE_ERROR_LOG;
		if (version_compare(PHP_VERSION, '5.3', '<'))
		{
			$this->_errors[] = sprintf('Your PHP version is %s, this module has been written for PHP 5.3 or higher.', PHP_VERSION);
		}
		if (file_exists($errorLogFile)) 
		{
			$this->_errors[] = sprintf(
				$this->l('An error log file exists, please read file `%s` and archive it to stop seeing this warning.'),
				$errorLogFile
			);
		}
		if (!$this->get(self::CNF_PRODUCTION))
		{
			$errorsIndex['BASIC']++;
			$this->_errors[] = $this->l('You are still in demonstration mode.');
		}
		if (!$this->get(self::CNF_BANK) || !array_key_exists($this->get(self::CNF_BANK), $this->_banks))
		{
			$errorsIndex['BASIC']++;
			$this->_errors[] = $this->l('No bank selected.');
		}
		if ($this->get(self::CNF_PRODUCTION) && !$this->get(self::CNF_MERCHANT_ID))
		{
			$errorsIndex['BASIC']++;
			$this->_errors[] = $this->l('No production certificate selected.');
		}
		if (!$this->get(self::CNF_NO_TID_GENERATION) && !$this->get(self::CNF_TID_TZ))
		{
			$errorsIndex['ADVANCED']++;
			$this->_errors[] = $this->l('Your transaction_id time zone is not set.');
		}
		if ($this->get(self::CNF_DEBUG_MODE))
		{
			$errorsIndex['ADVANCED']++;
			$this->_errors[] = $this->l('Debug mode is active.');
		}
		if ($this->get('CHECK_VERSION')) 
		{
			if (is_object($response = $this->checkNewVersion())) 
			{
				$this->_errors[] = sprintf($this->l('New version %s available at %s'), $response->currentVersion, $response->url);
				if (!empty($response->errorMessageIfLower))
					$this->_errors[] = sprintf($this->l('About version %s:'), $response->currentVersion) . ' ' . $response->errorMessageIfLower;
			}
		}
		if (ini_get('safe_mode'))
		{
			$this->_errors[] = $this->l('Safe mode is activated, this module is not compatible with PHP safe_mode.');
		}
		if (!$this->get(self::CNF_BINARIES_IN_PATH))
		{
			if (file_exists($this->get(self::CNF_BIN_PATH)) && is_dir($this->get(self::CNF_BIN_PATH)))
			{
				$cwd = getcwd();
				if (!chdir($this->get(self::CNF_BIN_PATH)))
				{
					$errorsIndex['ADVANCED']++;
					$this->_errors[] = sprintf($this->l('Unable to set binaries path ( %s ) as current working directory. ATOS binary executable call will probably fail.'), $this->get(self::CNF_BIN_PATH));
				}
				chdir($cwd);
			}
			else
			{
				$errorsIndex['ADVANCED']++;
				$this->_errors[] = sprintf($this->l('Binaries path \'%s\' does not exist, or is not a directory, or rights on it are to low to see it from PHP user. ATOS binary executable call will probably fail.'), $this->get(self::CNF_BIN_PATH));
			}
		}
		foreach (array(self::BIN_REQUEST => array(), self::BIN_RESPONSE => array('message=012345')) as $bin => $args)
		{
			$systemCall = $this->rawCall($bin, $args);
			if ($systemCall->exit_code != 0)
			{
				$this->_errors[] = sprintf($this->l('Error when calling %s binary, system exit code: %u, text output: %s'), $bin, $systemCall->exit_code, implode(PHP_EOL, $systemCall->output));
			}
		}
		if (!( $this->get(self::CNF_SINGLE) || $this->get(self::CNF_2TPAYMENT) || $this->get(self::CNF_3TPAYMENT) ))
		{
			$this->_errors[] = $this->l('No payment mode enabled');
		}
		foreach ($this->generatePathfileContent() as $name => $value)
		{
			if (strlen($value) > self::PATHFILE_VARLENGTH)
			{
				$this->_errors[] = sprintf($this->l('Pathfile %1$s value is %4$u characters long. An undocumented limitation of ATOS SIPS pathfile reader seems to disallow pathfile values to be longer than %3$u characters. F_* values can be shortened by moving param directory upper on the file system and updating corresponding entry in advanced conf.'), $name, $value, self::PATHFILE_VARLENGTH, strlen($value));
			}
		}
		if ($this->get(self::CNF_LOG_PATH) == $this->_confVarsByName[self::CNF_LOG_PATH]['default'])
		{
			$this->_errors[] = $this->l('Logs location is the default location which should be moved for security reason. Put it outside of HTTP document root and any public access folder if you can. Make sure no one who shouldn\'t has access to it. Do not forget to update module\'s config with new location in basic panel.');
		}
		if ($this->get(self::CNF_PARAM_PATH) == $this->_confVarsByName[self::CNF_PARAM_PATH]['default'])
		{
			$this->_errors[] = $this->l('ATOS SIPS parameter files location the default location which should be moved for security reason. Put it outside of HTTP document root and any public access folder if you can. Make sure no one who shouldn\'t has access to it. Do not forget to update module\'s config with new location in advanced panel.');
		}
		foreach (array('request', 'get', 'post') as $method)
		{
			$suhosin_key = 'suhosin.'.$method.'.max_value_length';
			$suhosin_value = ini_get($suhosin_key);
			if ($suhosin_value && $suhosin_value < 2048)
				$this->_errors[] = sprintf($this->l('%1$s PHP suhosin configuration value is %2$s. A value below 2048 could lead to the unability to process ATOS SIPS response. To know the exact value you need please take contact with your ATOS SIPS tech support. http://www.hardened-php.net/suhosin/configuration.html#%1$s'), $suhosin_key, $suhosin_value);
		}
		switch (count($this->_errors))
		{
			case 0:
				break;
			case 1:
				$this->warning = $this->_errors[0];
				break;
			default:
				$this->warning = sprintf($this->l('%u warnings/errors, see module\'s configuration page for more information'), count($this->_errors));
		}
		return $errorsIndex;
	}
	
	/**
	 * Check web repository to know if a new version is available
	 * @return boolean|array
	 */
	public function checkNewVersion() 
	{
		try {
			$data = array(
				'module_version' => $this->version,
				'ps_version' => _PS_VERSION_,
				'shop' => $this->context->shop->getBaseURL(),
				'lang' => $this->context->language->iso_code
			);
			$dataencoded = array();
			foreach ($data as $name => $value)
				$dataencoded[] = urlencode($name).'='.urlencode($value);
			$dataencoded = implode('&', $dataencoded); 
			$opts = array(
				'http' => array(
					'method' => 'POST',
					'header' => 'Connection: close', 
					'timeout' => 3,
					'content' => $dataencoded
				)
			);
			$context = stream_context_create($opts);
			$response = @file_get_contents('http://ws.tggatos.capillotracteur.fr/checkVersion', false, $context);
			if (empty($response))
				throw new Exception('Check version call failed: no response');
			$responseObj = json_decode($response);
			if (!is_object($responseObj))
				throw new Exception('Check version call failed: response cannot be decoded, received: '.$response);
			if (version_compare($this->version, $responseObj->currentVersion, '<'))
				return $responseObj;
		} catch (Exception $e) {
			$this->_errors[] = sprintf('Check version error: %s', $e->getMessage()); 
		}
		return false;
	}
	
	public function paramsToArgs(array $params)
	{
		$args = array();
		foreach ($params as $name => $value)
			if (!empty($value) || $value === 0 || $value === '0')
				$args[] = $name.'='.$value;
		return $args;
	}
	
	/**
	 * Execute a binary file from ATOS API
	 * @param unknown $bin_name
	 * @param array $args
	 * @return TggAtosModuleSystemCall
	 */
	public function rawCall($bin_name, array $args = array())
	{
		if (!empty($args))
		{
			$args = ' ' . implode(' ', array_map('escapeshellarg', $args));
		}
		else
		{
			$args = '';
		}
		return new TggAtosModuleSystemCall(escapeshellcmd(( $this->get(self::CNF_BINARIES_IN_PATH) ? '' : $this->get(self::CNF_BIN_PATH) ) . $bin_name . $this->get(self::CNF_BIN_SUFFIX)) . $args);
	}
	
	/**
	 * Update configuration if files has been updated
	 */
	public function postUpdate() 
	{
		$current_version = $this->get(self::CNF_VERSION);
		if (!$current_version)
			$current_version = '0';
		$toUpdate = array();
		foreach ($this->_newConfVars as $version => $vars)
			if (version_compare($this->version, $current_version, '>'))
				$toUpdate = array_merge($toUpdate, $vars);
		if ($this->setDefaults($toUpdate))
			$this->set(self::CNF_VERSION, $this->version);
		$this->updateAtosParamFiles();
	}
	
	/**
	 * Set internal configuration default values, optionnaly filterer by an array of variables to set to their default values
	 * @param array $toUpdate Array of configuration variables to set to default value, null for a global configuration init
	 * @return boolean Global configuration update result (FALSE if any failed)
	 */
	public function setDefaults($toUpdate = null) 
	{
		$defaults = array();
		$this->initConfVars();
		foreach ($this->_confVars as $section)
			foreach ($section as $name => $declaration)
		{
			if (is_array($toUpdate) && !in_array($name, $toUpdate)) continue;
			if ($declaration['type'] == self::T_NONE) continue;
			$defaults[$name] = $declaration['default'];
			if ($defaults[$name] instanceof TggAtosModuleDynamicValue)
				$defaults[$name] = $defaults[$name]->getValue($this);
		}
		$retval = TRUE;
		foreach ($defaults as $k => $v) $retval = $this->set($k, $v) && $retval;
		return $retval;
	}
	
	private $_orderStatesArrayCache;
	/**
	 * Get an associative array of available order states formated for select input
	 * @param $prependEmptyLine Prepend an empty line to select
	 * @return array [id] => name
	 */
	public function getOrderStatesSelectArray($prependEmptyLine = FALSE)
	{
		if (empty($this->_orderStatesArrayCache))
		{
			$this->_orderStatesArrayCache = array();
			foreach (OrderState::getOrderStates($this->context->language->id) as $order_state)
			{
				$this->_orderStatesArrayCache[$order_state['id_order_state']] = $order_state['name'];
			}
		}
		if ($prependEmptyLine)
			return array(is_bool($prependEmptyLine) ? '' : $prependEmptyLine) + $this->_orderStatesArrayCache;
		return $this->_orderStatesArrayCache;
	}
	
	private $_currenciesCache;
	/**
	 * Returns an array of enabled currencies (allowed and declared in static atos array $this->_currencies)
	 * @return array Currency db rows enabled fo this module
	 */
	public function getCurrencies() 
	{
		if (empty($this->_currenciesCache))
		{
			$this->_currenciesCache = $this->getCurrency($this->context->currency->id);
		}
		return $this->_currenciesCache;
	}
	
	private $_currenciesArraySelectCache;
	/**
	 * Get an associative array of available currencies formated for select input
	 * @return array [iso_code] => name
	 */
	public function getCurrenciesArraySelect() 
	{
		if (empty($this->_currenciesArraySelectCache))
		{
			$this->_currenciesArraySelectCache = array();
			foreach ($this->getCurrencies() as $currency)
				$this->_currenciesArraySelectCache[$currency['iso_code']] = $currency['name'];
		}
		return $this->_currenciesArraySelectCache;
	}
	
	public function getTimeZonesArraySelect()
	{
		$array = DateTimeZone::listIdentifiers();
		array_unshift($array, '');
		return $this->_mirrorArray($array);
	}
	
	/**
	 * @param array $array
	 * @return array return input array where indexes are replaced with values 
	 */
	private function _mirrorArray(array $array)
	{
		$return = array();
		foreach ($array as $v)
			$return[$v] = $v;
		return $return;
	}
	
	/**
	 * Never called method added to force translation keys to exists when parsed by PS module translation key finder
	 */
	private function ___forceTranslationKeys()
	{
		$this->l('BASIC');
		$this->l('SINGLE');
		$this->l('2TIMES');
		$this->l('3TIMES');
		$this->l('GRAPHIC');
		$this->l('ADVANCED');
	}
	
	public function error($line, $message, $severity = 4, $object = NULL, $dieIfDevMode = true, $dieAnyway = false, $file = __FILE__)
	{
		$error = $file.'('.$line.'): '.$message;
		$errorlog = $error;
		$fullError = $error.(is_null($object) ? '' : PHP_EOL.'debug object: '.print_r($object, true));
		$errorlog = $fullError;
		if (!is_null($object))
		{
			$objectOutput = print_r($object, true);
			$loggerMessageDefinition = ObjectModel::getDefinition('Logger', 'message');
			if ($loggerMessageDefinition['validate'] === 'isMessage')
			{
				if (!Validate::isMessage($objectOutput))
				{
					$errorlog = $error .PHP_EOL.'debug object: '.sprintf(
							'Can\'t dump debug object `%s` to Prestashop logger, please see `%s` in module\'s log directory.',
							is_object($object)
								? get_class($object)
								: gettype($object),
							self::FILE_ERROR_LOG
					);
				}
			}
		}
		Logger::addLog($errorlog);
		$logfile = $this->get(self::CNF_LOG_PATH) . self::FILE_ERROR_LOG;
		$logFileHandle = fopen($logfile, 'a');
		if (is_resource($logFileHandle))
		{
			fwrite($logFileHandle, '|+> '.date('Y-m-d H:i:s').': ');
			fwrite($logFileHandle, $fullError);
			fwrite($logFileHandle, PHP_EOL);
			fclose($logFileHandle);
		}
		if (_PS_MODE_DEV_)
		{
			echo '<h2>'.nl2br(Tools::htmlentitiesUTF8($message), true).'</h2>';
			echo '<h3>'.$file.':'.$line.'</h3>';
			if (is_null($object) && $dieIfDevMode)
				exit;
			Tools::dieObject($object, $dieIfDevMode);
		}
		if ($dieAnyway)
			throw new PrestaShopModuleException($fullError);
	}
}

interface TggAtosModuleDynamicValue 
{
	/**
	 * Generic value resolver
	 * @param TggAtos $module
	 * @return unknown value
	 */
	public function getValue(TggAtos $module);
}

abstract class TggAtosModuleInternalDynamicValueAbstract implements TggAtosModuleDynamicValue 
{
	/* (non-PHPdoc)
	 * @see TggAtosModuleDynamicValue::getValue()
	 * 
	 * Resolution is delegated to module instance to allow the acces to protected/private property/function
	 */
	public function getValue(TggAtos $module) 
	{
		return $module->getDynamicValue($this);
	}
}

class TggAtosModuleProperty extends TggAtosModuleInternalDynamicValueAbstract {
	/**
	 * @var array
	 */
	private static $_instances = array();
	/**
	 * @var string
	 */
	private $_name;
	
	/**
	 * Static constructor wrapper to avoid doublons
	 * @param string $name Property name
	 * @return TggAtosModuleProperty
	 */
	public static function factory($name) {
		if (!isset(self::$_instances[$name]))
			self::$_instances[$name] = new self($name);
		return self::$_instances[$name];
	}
	
	/**
	 * @param string $name Property name
	 */
	public function __construct($name) {
		$this->_name = $name;
	}
	
	public function getPropertyName() {
		return $this->_name;
	}	
}

class TggAtosModuleFunctionCall extends TggAtosModuleInternalDynamicValueAbstract 
{
	/**
	 * @var array
	 */
	private static $_instances = array();
	/**
	 * @var string
	 */
	private $_funcName;
	/**
	 * @var array
	 */
	private $_parameters;
	
	/**
	 * Static constructor wrapper to avoid doublons
	 * @param string $name Property name
	 * @return TggAtosModuleProperty
	 */
	public static function factory($name, array $parameters = array()) {
		$cacheName = $name.'('.implode(',', $parameters).')';
		if (!isset(self::$_instances[$cacheName]))
			self::$_instances[$cacheName] = new self($name, $parameters);
		return self::$_instances[$cacheName];
	}

	/**
	 * @param string $funcName Function name
	 * @param array $parameters Optionnal array of parameters
	 */
	public function __construct($funcName, array $parameters = array()) 
	{
		$this->_funcName = $funcName;
		$this->_parameters = $parameters;
	}
	
	public function getFunctionName() 
	{
		return $this->_funcName;
	}
	
	public function getParameters()
	{
		return $this->_parameters;
	}
}

class TggAtosModuleSystemCall
{
	public $command;
	public $output;
	public $exit_code;
	public $last_line;
	
	public function __construct($command)
	{
		$this->command = $command;
		$this->last_line = exec($command, $this->output, $this->exit_code);
	}
}

class TggAtosModuleRequestOutputParser
{
	/**
	 * Call success
	 * @var bool
	 */
	public $success;
	public $error;
	public $form;
	
	public function __construct(TggAtosModuleSystemCall $call)
	{
		$output = explode('!', trim($call->last_line, '!'));
		list($atosResultCode, $atosError) = $output;
		if (isset($output[2])) $this->form = $output[2];
		$this->success = $atosResultCode == 0;
		$this->error = $atosError;
	}
}

class TggAtosModuleResponseObject
{
	const CONSTRUCT_NEW = 1;
	const CONSTRUCT_HYDRATE = 2;
	
	const TYPE_USER = 'user';
	const TYPE_SILENT = 'silent';
	
	public $merchant_id;
	public $merchant_country;
	public $amount;
	public $transaction_id;
	public $payment_means;
	public $transmission_date;
	public $payment_time;
	public $payment_date;
	public $response_code;
	public $payment_certificate;
	public $authorisation_id;
	public $currency_code;
	public $card_number;
	public $cvv_flag;
	public $cvv_response_code;
	public $bank_response_code;
	public $complementary_code;
	public $complementary_info;
	public $return_context;
	public $caddie;
	public $receipt_complement;
	public $merchant_language;
	public $language;
	public $customer_id;
	public $order_id;
	public $customer_email;
	public $customer_ip_address;
	public $capture_day;
	public $capture_mode;
	public $data;
	
	public $original_message;
	public $caller_ip_address;
	public $response_type;
	
	public $dataFlags = array();
	public $dataVars = array();
	
	public static $fields = array(
		'merchant_id',
		'merchant_country',
		'amount',
		'transaction_id',
		'payment_means',
		'transmission_date',
		'payment_time',
		'payment_date',
		'response_code',
		'payment_certificate',
		'authorisation_id',
		'currency_code',
		'card_number',
		'cvv_flag',
		'cvv_response_code',
		'bank_response_code',
		'complementary_code',
		'complementary_info',
		'return_context',
		'caddie',
		'receipt_complement',
		'merchant_language',
		'language',
		'customer_id',
		'order_id',
		'customer_email',
		'customer_ip_address',
		'capture_day',
		'capture_mode',
		'data'
	);
	
	public static $shortResponseUnavailableFields = array(
		'caddie',
		'customer_email',
		'customer_id',
		'customer_ip_address',
		'merchant_language',
		'order_validity',
		'receipt_complement',
		'return_context',
		'transaction_condition'
	);
	
	public static $additionnalLoggableFields = array(
		'original_message',
		'caller_ip_address',
		'response_type'
	);
	
	public function __construct(array $responseFields, $originalMessage, $type, $mode = self::CONSTRUCT_NEW, TggAtos $module)
	{
		switch ($mode)
		{
			case self::CONSTRUCT_NEW:
				$this->original_message = $originalMessage;
				$this->response_type = $type;
				if (is_array($_SERVER) && isset($_SERVER['REMOTE_ADDR']))
					$this->caller_ip_address = $_SERVER['REMOTE_ADDR'];
				$fields = self::$fields;
				if (count($responseFields) < count($fields))
				{
					foreach (self::$shortResponseUnavailableFields as $field)
						array_splice($fields, array_search($field, $fields), 1);
					if (count($responseFields) != count($fields))
						$module->error(__LINE__, 'Fields count mismatch in uncyphered response', 4, array('received fields' => $responseFields, 'known fields' => self::$fields), true, true);
				}
				foreach ($fields as $pos => $name)
					if (isset($responseFields[$pos]))
						$this->{$name} = $responseFields[$pos];
				if (!empty($this->data))
				{
					foreach (explode(';', $this->data) as $dataPiece)
					{
						if (preg_match('/([^=]+)=(.*)/', $dataPiece, $matches))
						{
							$this->dataVars[$matches[1]] = $matches[2];
						} else {
							$this->dataFlags[$dataPiece] = TRUE;
						}
					}
				}
				break;
			case self::CONSTRUCT_HYDRATE:
				foreach ($responseFields as $name => $value)
					if (property_exists($this, $name))
						$this->{$name} = $value;
				break;
			default:
				throw new PrestaShopModuleException('Illegal argument $mode, must be one of self::CONSTRUCT_*');
		}			
	}
	
	public function hasDataFlag($flagname)
	{
		return !empty($this->dataFlags[$flagname]);
	}
	
	public function hasDataVar($varname)
	{
		return isset($this->dataVars[$varname]);
	}
	
	public function getDataVar($varname)
	{
		if (!$this->hasDataVar($varname))
			return null;
		return $this->dataVars[$varname];
	}
	
	/**
	 * @param array $data $name => $value hashmap
	 * @return TggAtosModuleResponseObject
	 */
	public static function hydrate($data, TggAtos $module)
	{
		return new self($data, null, null, self::CONSTRUCT_HYDRATE, $module);
	}
}

class TggAtosModuleResponseOutputParser
{
	/**
	 * Call success
	 * @var bool
	 */
	public $success;
	public $error;
	/**
	 * Response Object
	 * @var TggAtosModuleResponseObject
	 */
	public $response;
	
	public function __construct(TggAtosModuleSystemCall $call, $originalMessage, $type, TggAtos $module)
	{
		$output = explode('!', substr($call->last_line, 1));
		$this->success = array_shift($output) == 0;
		$this->error = array_shift($output);
		if ($this->success)
			$this->response = new TggAtosModuleResponseObject($output, $originalMessage, $type, TggAtosModuleResponseObject::CONSTRUCT_NEW, $module);
	}
}
