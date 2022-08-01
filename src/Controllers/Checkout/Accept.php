<?php

namespace Controllers\Checkout;

use Controllers\PrivateController;
use Dao\Orders\Order as DaoOrder;
use Dao\Orders\Cart as DaoCart;


class Accept extends PrivateController{
    public function run():void
    {
        $dataview = array();

        $CurrentUser = \Utilities\Security::getUserId();

        $token = $_GET["token"] ?: "";
        
        // $session_token = $_SESSION["orderid"] ?: "";
        $session_token = DaoOrder::getOrderToken($CurrentUser);

        if (intval($session_token["TokensCount"]) == 1) {
            if ($token !== "" && $token == $session_token["orderToken"]) {
                $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token["orderToken"]);
                
                //Orden Aceptada, Pago Realizado.
                $ShoppingSession = DaoCart::getShoppingSession($CurrentUser);
                $CartItems = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
                $CartSubTotal = DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"];
    
                try {
                    //Convert from Lps -> USD
                    $lpsInUsdValue = \Utilities\ExchangeCurrency::getUSDCurrentValue();
                    $USDTotal = 0;
    
                    if ($lpsInUsdValue != false) {
                        $USDTotal = round(doubleval($CartSubTotal) * $lpsInUsdValue,2); 
                    }
    
                    //Crear Orden
                    DaoOrder::createOrder($CurrentUser, DaoOrder::getOrderUtils()["NextOrderCode"], $CartSubTotal, $USDTotal);
                    $LastOrder = DaoOrder::getLastOrder($CurrentUser)["LastOrder"];
                    
                    //Insertar cada Producto en la Orden
                    foreach ($CartItems as $CartItem) {
                        $ProductKeys = DaoOrder::getProductKeys(intval($CartItem["invPrdId"]), intval($CartItem["quantity"]));
                        
                        //Asignar una clave disponible por cada cantidad de producto.
                        for ($i=0; $i < intval($CartItem["quantity"]); $i++) { 
                            DaoOrder::insertOrderItem($LastOrder, intval($CartItem["invPrdId"]), $ProductKeys[$i]["invClvId"]);
                            DaoOrder::disableKey($ProductKeys[$i]["invClvId"]);
                        }
                    }
    
                    //Registro de Datos de Pago
                    DaoOrder::insertPaymentData($LastOrder, $CartSubTotal, "PayPal", json_encode($result), "COM");
                    
                    //Eliminar del Carrito y Destruir la Session de Compra.
                    DaoCart::deleteAllCartItems($ShoppingSession["shopSessionId"]);
                    DaoCart::deleteShoppingSession($ShoppingSession["shopSessionId"]);
                    DaoOrder::deleteOrderToken($CurrentUser);

                    //Datos que van hacia la vista
                    $dataview["OrderDetails"] = DaoOrder::getOrderById($LastOrder);
                    $dataview["OrderItems"] = DaoOrder::getOrderItems($LastOrder);
            
                    $orderJSON = DaoOrder::getOrderById($LastOrder)[0]["orderJSON"];
                    $mainPPData = json_decode($orderJSON, true)["result"]["purchase_units"][0];
                    $secondaryPPData = json_decode($orderJSON, true)["result"]["payer"];
                    
                    $dataview["referenceId"] = $mainPPData["reference_id"];
                    $dataview["customer_name"] = $mainPPData["shipping"]["name"]["full_name"];
                    $dataview["address_line"] = $mainPPData["shipping"]["address"]["address_line_1"];
                    $dataview["admin_area"] = $mainPPData["shipping"]["address"]["admin_area_1"];
                    $dataview["postal_code"] = $mainPPData["shipping"]["address"]["postal_code"];
                    $dataview["country_code"] = $mainPPData["shipping"]["address"]["country_code"];
                    $dataview["email_address"] =$secondaryPPData["email_address"];
    
                } catch (\Throwable $th) {
                    error_log($th);
                    echo $th;
                }
    
                $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);

            } else {
                $dataview["orderjson"] = "No Order Available!!!";
                DaoOrder::deleteOrderToken($CurrentUser);
            }
        } 

    

        \Views\Renderer::render("paypal/accept", $dataview);
    }
}
?>
