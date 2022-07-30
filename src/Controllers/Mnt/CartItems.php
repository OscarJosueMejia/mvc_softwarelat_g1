<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Dao;
use Dao\Mnt\Cart as DaoCart;
use Dao\Mnt\Order as DaoOrder;
use Views\Renderer;

class CartItems extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $devUser = 1;
        $ShoppingSession = DaoCart::getShoppingSession($devUser);

        if($this->isPostBack()){
            /* Sumar 1 a la cantidad de producto seleccionado SOLO SI ESTA DISPONIBLE */
            if(isset($_POST['increaseQty'])){
                if ( DaoCart::getProductCountAvailable(intval($_POST["invPrdId"]))["disponibles_venta"] >= 1) {
                    DaoCart::updateCartItem(intval($ShoppingSession["shopSessionId"]), intval($_POST["cartItemId"]), intval($_POST["quantity"])+1);
                    DaoCart::updateShopSession($devUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
                }else{
                    echo "Ya no existe producto en stock";
                }
            }

            /* Restar 1 a la cantidad de producto seleccionado */
            if (isset($_POST['decreaseQty'])) {
                if (intval($_POST["quantity"])-1 > 0) {
                    DaoCart::updateCartItem(intval($ShoppingSession["shopSessionId"]), intval($_POST["cartItemId"]), intval($_POST["quantity"])-1);
                    DaoCart::updateShopSession($devUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
                }else{
                    echo "La cantidad no puede ser 0"; 
                }
            }

            /* Eliminar el Producto de la Sesion de Compra*/
            if (isset($_POST['deleteItem'])) {
                DaoCart::deleteCartItem(intval($_POST["cartItemId"]));
                DaoCart::updateShopSession($devUser, DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"]);
            }
        }
        
        if (!empty(DaoCart::getShoppingSession($devUser))) {
            $viewData["ShoppingSession"] = $ShoppingSession;
            $viewData["CartItems"] = DaoCart::getCartItems($ShoppingSession["shopSessionId"]);
            $viewData["SubTotal"] = DaoCart::getCartTotal(intval($ShoppingSession["shopSessionId"]))["session_total"];
            $viewData["ItemsCount"] = count($viewData["CartItems"]);
            $viewData["existentItems"] = true;
        }else{
            $viewData["ItemsCount"] = 0;
            $viewData["SubTotal"] = 0;
        }

        
        // error_log(json_encode($viewData));
      
        Renderer::render('mnt/cartitems', $viewData);
    }
}

?>
