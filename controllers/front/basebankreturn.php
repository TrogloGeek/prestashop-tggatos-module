<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 01/12/17
 * Time: 13:00
 */

/**
 * Class TggAtosBaseBankReturnFrontController
 * @property TggAtos $module
 */
abstract class TggAtosBaseBankReturnFrontController extends ModuleFrontController
{
    /**
     * @return string
     */
    protected abstract function getResponseType();

    /** @var null|string */
    protected $bankMessage = null;
    /** @var null|TggAtosModuleResponseObject */
    protected $bankResponse = null;

    public function init()
    {
        $this->bankMessage = Tools::getValue('DATA', null);
        if (!empty($this->bankMessage))
        {
            $this->bankResponse = $this->module->uncypherResponse($this->bankMessage, $this->getResponseType());
            if (!($this->bankResponse instanceof TggAtosModuleResponseObject)) {
                PrestaShopLogger::addLog(sprintf(
                    '%s: failed deciphering bank message: %s',
                    __METHOD__,
                    $this->bankMessage
                ), 3);
            }
        }
        parent::init();
    }

    protected function recoverCart()
    {
        if (!($this->bankResponse instanceof TggAtosModuleResponseObject)) {
            return false;
        }
        $cart = new Cart((int) $this->bankResponse->order_id);
        if (Validate::isLoadedObject($cart)) {
            $customer = new Customer((int) $cart->id_customer);
            if (Validate::isLoadedObject($customer)) {
                $customer->logged = 1;
                $this->context->customer = $customer;
                $this->context->cookie->id_customer = (int) $customer->id;
                $this->context->cookie->customer_lastname = $customer->lastname;
                $this->context->cookie->customer_firstname = $customer->firstname;
                $this->context->cookie->logged = 1;
                $this->context->cookie->check_cgv = 1;
                $this->context->cookie->is_guest = $customer->isGuest();
                $this->context->cookie->passwd = $customer->passwd;
                $this->context->cookie->email = $customer->email;

                return $cart->id;
            } else {
                throw new PrestaShopModuleException(sprintf(
                    '%s: unable to restore Customer#%s for Cart#%s, cannot process bank response',
                    __METHOD__,
                    $cart->id_customer,
                    $this->bankResponse->order_id
                ));

            }
        } else {
            throw new PrestaShopModuleException(sprintf(
                '%s: unable to restore Cart#%s, cannot process bank response',
                __METHOD__,
                $this->bankResponse->order_id
            ));
        }
    }
}
