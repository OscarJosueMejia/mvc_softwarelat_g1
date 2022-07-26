<?php

namespace Controllers\Orders;

use Controllers\PrivateController;
use Dao\Orders\Cart as DaoCart;
use Dao\Orders\Order as DaoOrder;
use Views\Renderer;

class CartItems extends PrivateController
{
    public function run():void
    {
        $viewData = array();
        $CurrentUser = \Utilities\Security::getUserId();
        
        $ShoppingSession = DaoCart::getShoppingSession($CurrentUser);
        $cartErrors = false;
        $viewData["ErrorDescription"] = "";

        //Eliminar sesiones mayores a 3 Dias de modification.
        try {
            DaoCart::deleteSessionsByTime();
        } catch (\Throwable $th) {
            error_log($th);
        }

        if($this->isPostBack()){
            /* Sumar 1 a la cantidad de producto seleccionado SOLO SI ESTA DISPONIBLE */
            if(isset($_POST['increaseQty'])){
                if ( DaoCart::getProductCountAvailable(intval($_POST["invPrdId"]))["disponibles_venta"] >= 1) {
                    DaoCart::updateCartItem(intval($ShoppingSession["shopSessionId"]), intval($_POST["cartItemId"]), intval($_POST["quantity"])+1);
                    DaoCart::updateShopSession($CurrentUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
                }else{
                    $cartErrors = true;
                    $viewData["ErrorDescription"] = "No hay suficiente inventario de producto.";
                }
            }

            /* Restar 1 a la cantidad de producto seleccionado */
            if (isset($_POST['decreaseQty'])) {
                if (intval($_POST["quantity"])-1 > 0) {
                    DaoCart::updateCartItem(intval($ShoppingSession["shopSessionId"]), intval($_POST["cartItemId"]), intval($_POST["quantity"])-1);
                    DaoCart::updateShopSession($CurrentUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
                }else{
                    $cartErrors = true;
                    $viewData["ErrorDescription"] = "La Cantidad de Producto no puede ser 0.";
                }
            }

            /* Eliminar el Producto de la Sesion de Compra*/
            if (isset($_POST['deleteItem'])) {
                DaoCart::deleteCartItem(intval($_POST["cartItemId"]));
                DaoCart::updateShopSession($CurrentUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
            }

            /* Revisar si no hay cambios en el stock*/
            if (isset($_POST['goPayPal'])) {

                $SelectedProducts = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
                
                foreach ($SelectedProducts as $CartItem) {
                    $AvailableQuantity = DaoCart::secondCheckProducts($CartItem["invPrdId"],$ShoppingSession["shopSessionId"]); 
                    if ($AvailableQuantity < $CartItem["quantity"]) {
                        $cartErrors = true;
                        $viewData["ErrorDescription"] .= "-<strong>".$CartItem["invPrdName"] . "</strong> Excede la cantidad en stock. Cantidad máxima que se puede seleccionar: <strong>".$AvailableQuantity." items.</strong><br><br>"; 
                    }
                }
                if (!$cartErrors) {
                    
                    DaoOrder::deleteOrderToken($CurrentUser);
                    \Utilities\Site::redirectTo("index.php?page=checkout_checkout");
                }
            }
        }
        
        if (!empty(DaoCart::getShoppingSession($CurrentUser))) {
            $viewData["ShoppingSession"] = $ShoppingSession;
            $viewData["CartItems"] = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
            $viewData["SubTotal"] = DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_subtotal"];
            $viewData["ISV"] = round(doubleval($viewData["SubTotal"]) * 0.15,2);
            $viewData["Total"] = DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"];
            $viewData["ItemsCount"] = DaoCart::getCartAllItems(intval($ShoppingSession["shopSessionId"]));
            $viewData["existentItems"] = true;
           
            $lpsInUsdValue = \Utilities\ExchangeCurrency::getUSDCurrentValue();
            if ($lpsInUsdValue != false) {
                $viewData["DollarsTotal"] = round($lpsInUsdValue * doubleval($viewData["Total"]),2);
            }
            
        }else{
            $viewData["ItemsCount"] = 0;
            $viewData["SubTotal"] = 0;
            $viewData["ISV"] = 0;
            $viewData["Total"] = 0;
            $viewData["DollarsTotal"] = 0;
        }

        if ($cartErrors) {
            $viewData["ErrorTrigger"] = "<script type='text/javascript'>
                                        $(document).ready(function () {
                                            $('#errorModal').modal('show');
                                        });</script>";
        }


        // error_log(json_encode($viewData));
        Renderer::render('orders/cartitems', $viewData);
    }
}

?>
