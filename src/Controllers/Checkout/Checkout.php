<?php

namespace Controllers\Checkout;

use Controllers\PrivateController;
use Dao\Orders\Cart as DaoCart;
use Dao\Orders\Order as DaoOrder;

class Checkout extends PrivateController{
    public function run():void
    {
        $viewData = array();
        $CurrentUser = \Utilities\Security::getUserId();
        
        if (!empty(DaoCart::getShoppingSession($CurrentUser))) {
            $ShoppingSession = DaoCart::getShoppingSession($CurrentUser);
            $CartItems = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
            
            DaoCart::extendShopSession($CurrentUser);
            //Convert from Lps -> USD
            $lpsInUsdValue = \Utilities\ExchangeCurrency::getUSDCurrentValue();
    
            if ($lpsInUsdValue !== false) {

                $basedir = \Utilities\Context::getContextByKey("BASE_DIR");
                $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                    "test".(time() - 10000000),
                    "http://localhost/".$basedir."/index.php?page=checkout_error",
                    "http://localhost/".$basedir."/index.php?page=checkout_accept"
                );
                
                foreach ($CartItems as $CartItem) {
                    $PayPalOrder->addItem($CartItem["invPrdName"], 
                    $CartItem["catnom"],
                    $CartItem["invPrdId"],
                    round(doubleval($CartItem["invPrdPriceISV"]) * $lpsInUsdValue, 2), 
                    0,  
                    $CartItem["quantity"], 
                    "DIGITAL_GOODS");
                }
        
                $response = $PayPalOrder->createOrder();
                
                $order_id = $response[1]->result->id;
                $result = DaoOrder::saveOrderToken($CurrentUser, $order_id);
                // $_SESSION["orderid"] = $order_id;
                // setcookie("orderid", $response[1]->result->id, time()+3600);
                
                if ($result) {
                    \Utilities\Site::redirectTo($response[0]->href);
                }else{
                    \Utilities\Site::redirectTo("index.php?page=orders_cartItems");
                }

                die();
            }else{
                \Utilities\Site::redirectTo("index.php?page=orders_cartItems");
                die();
            }

        }else{
            \Utilities\Site::redirectTo("index.php?page=orders_cartItems");
        }

        \Views\Renderer::render("paypal/checkout", $viewData);
    }
}
?>
