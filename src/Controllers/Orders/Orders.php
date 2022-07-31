<?php

namespace Controllers\Orders;

use Controllers\PublicController;
use Dao\Dao;
use Dao\Orders\Order as DaoOrder;
use Views\Renderer;

class Orders extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $devUser = 1;

        // (\Utilities\Security::isInRol(\Utilities\Security::getUserId(), "ADM"))
        if(\Utilities\Security::isInRol($devUser, "ADM")){
            $viewData["Orders"] = DaoOrder::getOrdersAdm();
        }else{
            $viewData["Orders"] = DaoOrder::getOrders($devUser);
        }
        
        Renderer::render('orders/orders', $viewData);
    }
}

?>
