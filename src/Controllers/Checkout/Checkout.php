<?php

namespace Controllers\Checkout;
use Dao\Orders\Cart as DaoCart;

use Controllers\PublicController;

class Checkout extends PublicController{
    public function run():void
    {
        $viewData = array();
        $devUser = 1;
        
        if (!empty(DaoCart::getShoppingSession($devUser))) {
            $ShoppingSession = DaoCart::getShoppingSession($devUser);
            $CartItems = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
            
            DaoCart::extendShopSession($devUser);
            //Convert from Lps -> USD
            $lpsInUsdValue = \Utilities\ExchangeCurrency::getUSDCurrentValue();
    
            if ($lpsInUsdValue !== false) {
                $PayPalOrder = new \Utilities\Paypal\PayPalOrder(
                    "test".(time() - 10000000),
                    "http://localhost/NegociosWeb/mvc_softwarelat_g1/index.php?page=checkout_error",
                    "http://localhost/NegociosWeb/mvc_softwarelat_g1/index.php?page=checkout_accept"
                );
                
                foreach ($CartItems as $CartItem) {
                    $PayPalOrder->addItem($CartItem["invPrdName"], 
                    $CartItem["invPrdDsc"],
                    $CartItem["invPrdId"],
                    round(doubleval($CartItem["invPrdPriceISV"]) * $lpsInUsdValue, 2), 
                    0,  
                    $CartItem["quantity"], 
                    "DIGITAL_GOODS");
                }
        
                $response = $PayPalOrder->createOrder();
                
                $order_id = $response[1]->result->id;
                
                
                $_SESSION["orderid"] = $order_id;
                setcookie("orderid", $response[1]->result->id, time()+3600);
    
                \Utilities\Site::redirectTo($response[0]->href);

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
