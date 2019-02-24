<?php

/**
 * @property TggAtos $module
 */
class TggAtosPaymentGatewayModuleFrontController extends ModuleFrontController
{

    public function __construct()
    {
        parent::__construct();
        $this->ssl = true;
    }

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();

        $this->context->smarty->assign(array(
            'tggatos_pathURI' => $this->module->getPathUri(),
            'tggatos_sipsForm' => $this->module->getPaymentRedirectionFormFromContext(Tools::getValue('mode', TggAtos::MODE_SINGLE))
        ));

        $this->setTemplate('module:'.$this->module->name.'/views/templates/front/payment_gateway.tpl');
    }
}
