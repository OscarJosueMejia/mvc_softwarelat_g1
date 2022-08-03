<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers\Productos;

use Controllers\PublicController;
use Dao\Admin\Productos as DaoProductos;
use Dao\Orders\Cart as DaoCart;
use Views\Renderer;
/**
 * Prd_detail Controller
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class Detalle extends PublicController
{
    /**
     * Prd_detail run method
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array();
        $viewData["isOutStock"] = false;


        if ($this->isPostBack()) {

            if (\Utilities\Security::isLogged()){
                if (isset($_POST["btnComprar"]) && isset($_GET["id"])) {
                    $CurrentUser = \Utilities\Security::getUserId();
    
                    if (DaoCart::checkIfProductIsOnCart($_POST["invPrdId"],$CurrentUser)) {
                        \Utilities\Site::redirectToWithMsg("index.php?page=orders_cartItems","El Producto ya esta registrado en su carrito de compra.", "¡Lo Sentimos!", true);
                    }else{
                        $UserShopSession = "";
                        try {
                            if (DaoCart::getProductCountAvailable(intval($_POST["invPrdId"]))["disponibles_venta"] >= intval($_POST["txtCant"])) {
                                
                                if (!DaoCart::checkExistentShopSession($CurrentUser)) {
                                    DaoCart::createShopSession($CurrentUser);
                                }
    
                                $UserShopSession = DaoCart::getShoppingSessionId($CurrentUser);
                            
                                DaoCart::insertCartItem($UserShopSession, $_POST["invPrdId"],  $_POST["txtCant"]);
                                DaoCart::updateShopSession($CurrentUser, DaoCart::getCartTotal($UserShopSession)["session_total"]);
                            
                                \Utilities\Site::redirectToWithMsg("index.php?page=orders_cartItems","Producto Agregado al Carrito de Compra.", "Operación Realizada Exitosamente", false);
                            }else{
                                \Utilities\Site::redirectToWithMsg("index.php","No hay Suficiente Stock del Producto Seleccionado.", "¡Lo Sentimos!", true);
                            }
                        } catch (\Throwable $th) {
                            echo $th;
                        }
                    }
                }
            }else{
                \Utilities\Site::redirectToWithMsg("index.php?page=sec_login","Inicie sesión con su cuenta para agregar productos al carrito.", "Iniciar Sesión", true);

            }
        }

        if(isset($_GET["id"])) {
            $invPrdId = intval($_GET["id"]);
            $tmpProducto = DaoProductos::getByIdForDetail($invPrdId);
            $tmpStock = DaoProductos::getStockByIdForDetail($invPrdId);
            
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProducto, $viewData);
            \Utilities\ArrUtils::mergeFullArrayTo($tmpStock, $viewData);

            if (intval($viewData["disponibles_venta"]) == 0) {
                $viewData["isOutStock"] = true;
            }

            $viewData["Productos"] = DaoProductos::getAllFeatureProducts();
        }else{
          \Utilities\Site::redirectTo("index.php?page=orders_cartItems");
        }

        error_log(json_encode($viewData));
        Renderer::render("productos/detalle", $viewData);
    }
}
?>
