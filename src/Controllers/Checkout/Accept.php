<?php

namespace Controllers\Checkout;

use Dao\Mnt\Order as DaoOrder;
use Dao\Mnt\Cart as DaoCart;

use Controllers\PublicController;
class Accept extends PublicController{
    public function run():void
    {
        // $dataview = array();
        // $devUser = 1;

        // $token = $_GET["token"] ?: "";
        // $session_token = $_SESSION["orderid"] ?: "";

        // if ($token !== "" && $token == $session_token) {

        //     $result = \Utilities\Paypal\PayPalCapture::captureOrder($session_token);
            
        //     //Orden Aceptada, Pago Realizado.
        //     $ShoppingSession = DaoCart::getShoppingSession($devUser);
        //     $CartItems = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
        //     $CartSubTotal = DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"];

        //     try {
        //         //Crear Orden
        //         DaoOrder::createOrder($devUser, $CartSubTotal);
        //         $LastOrder = DaoOrder::getLastOrder($devUser)["LastOrder"];
                
        //         //Insertar cada Producto en la Orden
        //         foreach ($CartItems as $CartItem) {
        //             $ProductKeys = DaoOrder::getProductKeys(intval($CartItem["invPrdId"]), intval($CartItem["quantity"]));
                    
        //             //Asignar una clave disponible por cada cantidad de producto.
        //             for ($i=0; $i < intval($CartItem["quantity"]); $i++) { 
        //                 DaoOrder::insertOrderItem($LastOrder, intval($CartItem["invPrdId"]), $ProductKeys[$i]["invClvId"]);
        //             }
        //         }

        //         DaoOrder::insertPaymentData($LastOrder, $CartSubTotal, "PAYPAL", json_encode($result), "COM");
                
        //         //Eliminar del Carrito y Destruir la Session de Compra.
                

        //     } catch (\Throwable $th) {
        //         error_log($th);
        //         echo $th;
        //     }

        //     $dataview["orderjson"] = json_encode($result, JSON_PRETTY_PRINT);
        // } else {

        //     $dataview["orderjson"] = "No Order Available!!!";
        // }
        
        $dataview["OrderDetails"] = DaoOrder::getOrderById(1);
        $dataview["OrderItems"] = DaoOrder::getOrderItems(1);

        $orderJSON = DaoOrder::getOrderById(1)[0]["orderJSON"];
        $mainPPData = json_decode($orderJSON, true)["result"]["purchase_units"][0];
        $secondaryPPData = json_decode($orderJSON, true)["result"]["payer"];
        
        $dataview["referenceId"] = $mainPPData["reference_id"];
        $dataview["customer_name"] = $mainPPData["shipping"]["name"]["full_name"];
        $dataview["address_line"] = $mainPPData["shipping"]["address"]["address_line_1"];
        $dataview["admin_area"] = $mainPPData["shipping"]["address"]["admin_area_1"];
        $dataview["postal_code"] = $mainPPData["shipping"]["address"]["postal_code"];
        $dataview["country_code"] = $mainPPData["shipping"]["address"]["country_code"];
        $dataview["email_address"] =$secondaryPPData["email_address"];

        \Views\Renderer::render("paypal/accept", $dataview);
    }
}
?>
