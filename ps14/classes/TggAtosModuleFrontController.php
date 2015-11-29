<?php

/**
 * Created by PhpStorm.
 * User: damien
 * Date: 03/11/15
 * Time: 15:52
 */
class TggAtosModuleFrontController extends FrontController
{
    protected $module;
    protected $context;
    protected $template;

    public function init()
    {
        parent::init();
        $this->module = Module::getInstanceByName('tggatos');
        $this->context = $this->module->context;
    }


    function initContent()
    {

    }

    public function displayContent()
    {
        $this->initContent();
        parent::displayContent();
        self::$smarty->display(implode(DIRECTORY_SEPARATOR, array(_PS_MODULE_DIR_, $this->module->name, 'views', 'templates', 'front', $this->template)));
    }

    protected function setTemplate($template)
    {
        $this->template = $template;
    }
}
