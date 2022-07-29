<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Cart as DaoCart;
use Views\Renderer;

class CartItems extends PublicController
{
    public function run():void
    {
        $ShoppingSession = DaoCart::getShoppingSession(1);
        $viewData = array();

        $viewData["ShoppingSession"] = $ShoppingSession;
        $viewData["CartItems"] = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
        // error_log(json_encode($viewData));
      
        Renderer::render('mnt/cartitems', $viewData);
    }
}

?>
