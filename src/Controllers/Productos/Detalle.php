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

        if (!$this->isPostBack()) {
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
        }

        error_log(json_encode($viewData));
        Renderer::render("productos/detalle", $viewData);
    }
}
?>
