<?php
namespace Controllers\Admin;

use Dao\Admin\Productos as DaoProductos;
use Views\Renderer;

class Dashboard extends \Controllers\PrivateController
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // $userInRole = \Utilities\Security::isInRol(
        //     \Utilities\Security::getUserId(),
        //     "ADMIN"
        // );
        parent::__construct();
    }

    public function run() :void
    {
        $viewData = array();
        $op = 0;
        $arrLabels = array();
        $arrData = array();
            
        
        
        if(isset($_GET["op"])) {
            $op = intval($_GET["op"]);
        
            if ($op == 1) {
                $arrForDash = DaoProductos::getAllFeatureProducts();
                foreach ($arrForDash as $key) {
                    $arrLabels[] = $key["invPrdName"];
                    $arrData[] = $key["CantidadVendida"];
                }
                $viewData["mode"] = "Licencias más vendidas";

                $viewData["optionLinkHREF"] = "index.php?page=admin_dashboard&op=2";
                $viewData["optionLinkText"] = "Ver Ventas por mes";
            } else {
                $arrForDash = DaoProductos::getSalesCountByMonth();
                foreach ($arrForDash as $key) {
                    $arrData[] = $key["cantVentas"];
                }
                $arrLabels = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                $viewData["mode"] = "Ventas por mes";
            
                $viewData["optionLinkHREF"] = "index.php?page=admin_dashboard&op=1";
                $viewData["optionLinkText"] = "Ver Licencias más vendidas";
            }

            $viewData["labels"] = json_encode($arrLabels);
            $viewData["data"] = json_encode($arrData);

            $viewData["optionLinkSHOW"] = true;
        }
        
        
        Renderer::render('admin/dashboard', $viewData);
    }
}
?>
