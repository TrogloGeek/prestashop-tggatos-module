<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 28/11/17
 * Time: 13:00
 */

/**
 * Class TggAtosAjaxModuleFrontController
 * @property TggAtos $module
 */
class TggAtosAjaxModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        while (ob_get_level()) {
            ob_end_clean();
        }
        $message = Tools::getValue('message');
        $response = $this->module->uncypherResponse($message, TggAtosModuleResponseObject::TYPE_USER);
        $id_cart = (int)$response->order_id;
        $action = Tools::getValue('action');
        switch ($action) {
            case 'process-response':
                $lock = null;
                $hasLock = $this->module->tryCreateResponseLock($id_cart, $lock);
                if (!$hasLock) {
                    die(json_encode([
                        'result' => false
                    ]));
                }
                $order = $this->module->processResponse($response);
                $this->module->removeResponseLock($id_cart, $lock);
                $url = null;
                if ($order instanceof OrderCore) {
                    $url = $this->context->link->getPageLink('order-confirmation', null, null, [
                        'id_cart' => $id_cart,
                        'id_module' => $this->module->id,
                        'key' => $order->secure_key,
                        'sips_message' => $message
                    ]);
                } else {
                    $url = $this->module->getModuleLink(TggAtos::CTRL_PAYMENT_FAILURE, [
                        'message' => $message
                    ]);
                }
                die(json_encode([
                    'result' => true,
                    'url' => $url
                ]));
            default:
                die('');
        }

    }

}
