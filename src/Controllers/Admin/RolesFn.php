<?php 
/**
 * @author: Oscar Mejia
 */
namespace Controllers\Admin;

use Views\Renderer;
use Utilities\Validators;
use Dao\Admin\Roles;
use Dao\Security\Security;
use Dao\Admin\Funciones as DaoFunciones;

class RolesFn extends \Controllers\PrivateController {

    private $viewData = array();
    private $arrModeDesc = array();
    private $arr_rolesest = array();
            
    public function run():void
    {
        $this->viewData = array();
        
        if ($this->isPostBack()) {
            try {
                if (isset($_POST["btnDeleteFunction"])) {
                    Security::removeFeatureFromRol($_POST["fncod"], $_POST["rolescod"]);
                }
    
                if (isset($_POST["btnAddFunction"])) {
                    if(Roles::isFeatureInRol($_POST["rolescod"], $_POST["fncod"], 'INA')){
                        Roles::activateFeatureInRol($_POST["rolescod"], $_POST["fncod"]);
                    }else{
                        Roles::insertFeatureInRol($_POST["rolescod"], $_POST["fncod"]);
                    }
                }
            } catch (\Throwable $th) {
                echo $th;
                error_log($th);
            }
        }

        if (isset($_GET["id"])) {
            $functions = DaoFunciones::getAll();
            $allFunction = array();
            foreach ($functions as $function) {
                $function["isFunctionInRol"] = Roles::isFeatureInRol($_GET["id"], $function["fncod"], 'ACT') == true;
                $function["NotIsFunctionInRol"] = Roles::isFeatureInRol($_GET["id"], $function["fncod"], 'ACT') == false;
                $function["rolescod"] = $_GET["id"];
                array_push($allFunction, $function);
            }
            $this->viewData["allFunctions"] = $allFunction;
            $this->viewData["rolescod"] = $_GET["id"];
        }else{
            \Utilities\Site::redirectTo("index.php?page=admin_roles");
        }

        Renderer::render("admin/rolesfn", $this->viewData);
    }
}