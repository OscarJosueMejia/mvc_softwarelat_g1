<?php 
namespace Controllers\Admin;

use Views\Renderer;
use Utilities\Validators;
use Dao\Admin\Funciones;

class Funcion extends \Controllers\PrivateController {

    private $viewData = array();
    private $arrModeDesc = array();

        private $arr_fnest = array();
        
        private $arr_fntyp = array();
        

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
    Renderer::render("admin/funcion", $this->viewData);
}
    private function init(){
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";

        //Var set guided by Table Info
        $this->viewData["fncod"] = "";
        $this->viewData["error_fncod"] = array();
        $this->viewData["fndsc"] = "";
        $this->viewData["error_fndsc"] = array();
        $this->viewData["fnest"] = "";
        $this->viewData["fnestArr"] = array();
        $this->viewData["fntyp"] = "";
        $this->viewData["fntypArr"] = array();
        // ------
        
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nueva Función",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminando %s %s"
        );

        $this->arr_fnest = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->viewData["fnestArr"] = $this->arr_fnest;
        
        $this->arr_fntyp = array(
            array("value" => "CTR", "text" => "Controlador"),
            array("value" => "VIE", "text" => "Vista"),
        );

        $this->viewData["fntypArr"] = $this->arr_fntyp;
    }

    private function procesarGet(){
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: El modo solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=admin_funciones",
                    "No se puede procesar su solicitud!", "Error en la operación Ejecutada", true
                );
            }
        }

        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["fncod"] = $_GET["id"];
            $tmpArray = Funciones::getById($this->viewData["fncod"]);
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
                "index.php?page=admin_funciones",
                "ERROR: Algo inesperado sucedió con la petición. Intente de nuevo.", "Error en la operación Ejecutada", true
            );
        }

        //Validation Zone
        if (Validators::IsEmpty($this->viewData["fncod"])) {
            $this->viewData["error_fncod"][]
                = "Este campo es requerido.";
            $hasErrors = true;
        }  
                
        if (Validators::IsEmpty($this->viewData["fndsc"])) {
            $this->viewData["error_fndsc"][]
                = "Este campo es requerido.";
            $hasErrors = true;
        }  
        //------
        
        if (!$hasErrors) {
            $result = null;

            switch($this->viewData["mode"]) {
            case "INS":

                try {
                    $result = Funciones::insert(
                        $this->viewData["fncod"],
                        $this->viewData["fndsc"],
                        $this->viewData["fnest"],
                        $this->viewData["fntyp"],
                    );
    
                    
                    if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_funciones",
                            "Función Guardada Satisfactoriamente!", "Operación Exitosa", false
                        );
                    }
                    break;
                } catch (\Throwable $th) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_funciones",
                        "No se pudo guardar la función.", "Error en la operación Ejecutada", true
                    );
                    break;
                }

            case "UPD":
                $result = Funciones::update(
                    $this->viewData["fndsc"],
                    $this->viewData["fnest"],
                    $this->viewData["fntyp"],
                    $this->viewData["fncod"]
                );

                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_funciones",
                        "Función Actualizada Satisfactoriamente!", "Operación Exitosa", false
                    );
                }
                break;

            case "DEL":
                $result = Funciones::delete(
                    $this->viewData["fncod"]
                );

                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_funciones",
                        "Función Eliminada Satisfactoriamente!", "Operación Exitosa", false
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
                $this->viewData["fncod"],
                $this->viewData["fndsc"],
            );
            
        $this->viewData["fnestArr"]
            = \Utilities\ArrUtils::objectArrToOptionsArray(
                $this->arr_fnest,
                "value",
                "text",
                "value",
                $this->viewData["fnest"]
            );            
        
        $this->viewData["fntypArr"]
            = \Utilities\ArrUtils::objectArrToOptionsArray(
                $this->arr_fntyp,
                "value",
                "text",
                "value",
                $this->viewData["fntyp"]
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
}?>