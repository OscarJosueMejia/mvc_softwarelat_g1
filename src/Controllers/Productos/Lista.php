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
use Dao\Admin\Categorias as DaoCategorias;
/**
 * Prd_detail Controller
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class Lista extends PublicController
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
        $catid = -1;
        $search = "";

        if(isset($_GET["pag"])) {
                $page = intval($_GET["pag"]);
                $productPerPage = 6;
                $limit = $productPerPage;

                $offset = ($page - 1) * $productPerPage;

                if (isset($_GET["catid"])) {
                    $catid = intval($_GET["catid"]);
                    $countProductos = DaoProductos::getProductsCount($catid, "'%%'");
                }
                else{
                    if (isset($_GET["sq"])) {
                        $search = $_GET["sq"];
                    }
                    
                    $countProductos = DaoProductos::getProductsCount(-1, "'%".$search."%'");
                }
                \Utilities\ArrUtils::mergeFullArrayTo($countProductos, $viewData);

                $pages = ceil($viewData["countProductos"] / $productPerPage);
                $viewData["perPage"] = $productPerPage;

                if(intval($productPerPage) > intval($viewData["countProductos"])){
                    $viewData["perPage"] = $viewData["countProductos"];
                }

                if(intval($viewData["countProductos"]) != 0){
                    $viewData["htmlPagCount"] = "<p style='margin-top: -10px; margin-bottom: 10px;'>Página ".$page." de ".$pages."</p>";
                } 
                else {
                    $viewData["htmlPagCount"] = "<p style='margin-top: -10px; margin-bottom: 10px;'>No se han encontrado productos.</p>";
                }

                if(intval($page) > 1){
                    $viewData["htmlPagBack"] = "<li><a href='index.php?page=productos_lista&pag=".(intval($page) - 1)."'><i class='fa fa-angle-left'></i></a></li>";
                }
                if(intval($page) < intval($pages)){
                    $viewData["htmlPagNext"] = "<li><a href='index.php?page=productos_lista&pag=".(intval($page) + 1)."'><i class='fa fa-angle-right'></i></a></li>";
                }
                $htmlPags = "";
                for ($i=1; $i <= intval($pages); $i++) { 
                    $htmlPags .= "<li ". ($i == intval($page) ? "class='current-page'" : "")." ><a href='index.php?page=productos_lista&pag=".($i)."'>".($i)."</a></li>";
                }
                $viewData["htmlPag"] = $htmlPags;

                if (isset($_GET["catid"])) {
                    $viewData["Productos"] = DaoProductos::getAllByPagination($limit, $offset, $catid, "'%%'");
                }
                else{
                    $viewData["Productos"] = DaoProductos::getAllByPagination($limit, $offset, -1, "'%".$search."%'");
                }

                $viewData["dataSetCategorias"] = DaoCategorias::getAllActives();

            }else{
              \Utilities\Site::redirectTo("index.php?page=index");
            }

        error_log(json_encode($viewData));
        Renderer::render("productos/lista", $viewData);
    }
}
?>
