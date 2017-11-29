<?php
require_once 'init.php';
//This controller does not use Prestashop Routing because ATOS/SIPS does not support GET parameters when using GET redirection form...
tggatos_autodispatch(__FILE__);
