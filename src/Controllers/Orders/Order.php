<?php

namespace Controllers\Orders;

use Dao\Mnt\Order as DaoOrder;

use Controllers\PublicController;

class Order extends PublicController{

    public function run():void
    {
        $dataview = array();

        if (!$this->isPostBack()) {
            
            if (isset($_GET["id"]) && isset($_GET["mode"])){
                $orderId = $_GET["id"];
                $dataview["OrderDetails"] = DaoOrder::getOrderById($orderId);
                $dataview["OrderItems"] = DaoOrder::getOrderItems($orderId);
        
                $orderJSON = DaoOrder::getOrderById($orderId)[0]["orderJSON"];
                $mainPPData = json_decode($orderJSON, true)["result"]["purchase_units"][0];
                $secondaryPPData = json_decode($orderJSON, true)["result"]["payer"];
                
                $dataview["referenceId"] = $mainPPData["reference_id"];
                $dataview["customer_name"] = $mainPPData["shipping"]["name"]["full_name"];
                $dataview["address_line"] = $mainPPData["shipping"]["address"]["address_line_1"];
                $dataview["admin_area"] = $mainPPData["shipping"]["address"]["admin_area_1"];
                $dataview["postal_code"] = $mainPPData["shipping"]["address"]["postal_code"];
                $dataview["country_code"] = $mainPPData["shipping"]["address"]["country_code"];
                $dataview["email_address"] =$secondaryPPData["email_address"];            
                \Views\Renderer::render("orders/order", $dataview);
            }else{
                \Utilities\Site::redirectTo("index.php?page=orders_orders");
            }
        }
    }
}
?>
