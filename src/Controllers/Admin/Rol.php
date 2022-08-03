<?php 
/**
 * @author: Oscar Mejia
 */
namespace Controllers\Admin;

use Views\Renderer;
use Utilities\Validators;
use Dao\Admin\Roles;
use Dao\Admin\Funciones as DaoFunciones;

class Rol extends \Controllers\PrivateController {

    private $viewData = array();
    private $arrModeDesc = array();
    private $arr_rolesest = array();
            
    public function run():void
    {
        $this->init();

        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        
        if ($this->isPostBack()) {
            $this->procesarPost();
        }

        $this->processView();
        Renderer::render("admin/rol", $this->viewData);
    }

    private function init(){
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";

        //Var set guided by Table Info
        $this->viewData["rolescod"] = "";
        $this->viewData["error_rolescod"] = array();
        $this->viewData["rolesdsc"] = "";
        $this->viewData["error_rolesdsc"] = array();
        $this->viewData["rolesest"] = "";
        $this->viewData["rolesestArr"] = array();
        
        // ------
        
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Rol",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminando %s %s"
        );

        
        $this->arr_rolesest = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INC", "text" => "Inactivo"),
        );
        $this->viewData["rolesestArr"] = $this->arr_rolesest;
    }

    private function procesarGet(){
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: El modo solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=admin_roles",
                    "No se puede procesar su solicitud!", "Error en la operación Ejecutada", true
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["rolescod"] = $_GET["id"];
            $tmpArray = Roles::getById($this->viewData["rolescod"]);
            \Utilities\ArrUtils::mergeFullArrayTo($tmpArray, $this->viewData);
        
        }

    }

    private function procesarPost()
    {
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);


        

        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=admin_roles",
                "ERROR: Algo inesperado sucedió con la petición. Intente de nuevo.", "Error en la operación Ejecutada", true
            );
        }

        //Validation Zone
        if (Validators::IsEmpty($this->viewData["rolescod"])) {
            $this->viewData["error_rolescod"][]
                = "Este campo es requerido.";
            $hasErrors = true;
        } 
        
        if (Validators::IsEmpty($this->viewData["rolesdsc"])) {
            $this->viewData["error_rolesdsc"][]
                = "Este campo es requerido.";
            $hasErrors = true;
        }  
        //------
        
        if (!$hasErrors) {
            $result = null;

            switch($this->viewData["mode"]) {
            case "INS":
                $result = Roles::insert(
                    $this->viewData["rolescod"],
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"],
                );

                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_roles",
                            "Rol Guardado Satisfactoriamente!", "Operación Exitosa", false
                        );
                }
                break;

            case "UPD":
                $result = Roles::update(
                    $this->viewData["rolesdsc"],
                    $this->viewData["rolesest"],
                    $this->viewData["rolescod"]
                );

                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_roles",
                        "Rol Actualizado Satisfactoriamente!","Operación Exitosa", false
                    );
                }
                break;

            case "DEL":
                $result = Roles::delete(
                    $this->viewData["rolescod"]
                );

                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_roles",
                        "Rol Eliminado Satisfactoriamente!","Operación Exitosa", false
                    );
                }
                break;
            }
        }
    }

    private function processView(){
        
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["rolescod"],
                $this->viewData["rolesdsc"]
            );

            
        $this->viewData["rolesestArr"]
            = \Utilities\ArrUtils::objectArrToOptionsArray(
                $this->arr_rolesest,
                "value",
                "text",
                "value",
                $this->viewData["rolesest"]
            );            
        
            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
            }
        }

        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}