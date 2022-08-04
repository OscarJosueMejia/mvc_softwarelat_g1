<?php

namespace Controllers\Orders;

use Controllers\PrivateController;
use Dao\Dao;
use Dao\Orders\Order as DaoOrder;
use Views\Renderer;

class Orders extends PrivateController
{
    public function run():void
    {
        $viewData = array();
        $CurrentUser = \Utilities\Security::getUserId();

        if(\Utilities\Security::isInRol($CurrentUser, "ADM") || \Utilities\Security::isInRol($CurrentUser, "SPU")){
            $viewData["Orders"] = DaoOrder::getOrdersAdm();
        }else{
            $viewData["Orders"] = DaoOrder::getOrders($CurrentUser);
        }
        
        Renderer::render('orders/orders', $viewData);
    }
}

?>
