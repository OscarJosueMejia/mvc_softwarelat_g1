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

        $viewData["Orders"] = DaoOrder::getOrders($devUser);
        // error_log(json_encode($viewData));
      
        Renderer::render('orders/orders', $viewData);
    }
}

?>
