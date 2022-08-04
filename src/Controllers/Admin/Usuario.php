<?php
namespace Controllers\Admin;

// ---------------------------------------------------------------
// Sección de imports
// ---------------------------------------------------------------
use Views\Renderer;
use Utilities\Validators;
use Dao\Admin\Usuarios as Usuarios;
use Dao\Admin\Roles as Roles;
use Sec\Exception;
use Throwable;

/**
 * Usuario
 *
 * @category Public
 * @package  Controllers\Mnt;
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class Usuario extends \Controllers\PrivateController
{
    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();
    private $arrTipoUsuario = array();

    /**
     * Runs the controller
     *
     * @return void
     */
    public function run():void
    {
        // code
        $this->init();
        // Cuando es método GET (se llama desde la lista)
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        // Ejecutar Siempre
        $this->processView();
        Renderer::render("admin/usuario", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["usercod"] = "";
        $this->viewData["useremail"] = "";
        $this->viewData["username"] = "";
        $this->viewData["userpswd"] = "";
        $this->viewData["userfching"] = "";
        $this->viewData["userpswdest"] = "";
        $this->viewData["useractcod"] = "";
        $this->viewData["userpswdexp"] = "";
        $this->viewData["userpswdchg"] = "";

        $this->viewData["error_useremail"] = array();
        $this->viewData["error_username"] = array();
        $this->viewData["error_userpswd"] = array();
        $this->viewData["error_userfching"] = array();
        $this->viewData["error_userpswdest"] = array();
        $this->viewData["error_userpswdexp"] = array();
        $this->viewData["error_useractcod"] = array();
        $this->viewData["error_userpswdchg"] = array();

        $this->viewData["userest"] = "";
        $this->viewData["userestArr"] = array();

        $this->viewData["usertipo"] = "";
        $this->viewData["usertipoArr"] = array();

        $this->viewData["isSuperUser"] = false; 
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["readonlyEmail"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Usuario",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $roles = Roles::getAll();
        
        foreach ($roles as $rol) {
            if ($rol["rolesest"]==="ACT" && $rol["rolescod"] !== "SPU") {
                array_push($this->arrTipoUsuario, array("value" => $rol["rolescod"], "text" => $rol["rolesdsc"]));
            }
        }


        $this->viewData["userestArr"] = $this->arrEstados;
        $this->viewData["usertipoArr"] = $this->arrTipoUsuario;

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: (Usuario) Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=admin_usuarios",
                    "No se puede procesar su solicitud!", "Error en la operación Ejecutada", true
                );
            }
        }

        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["usercod"] = intval($_GET["id"]);

            $tmpUsuarios = Usuarios::getUsuarioById($this->viewData["usercod"]);
            error_log(json_encode($tmpUsuarios));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpUsuarios, $this->viewData);
        }
    }


    private function procesarPost()
    {
        // Validar la entrada de Datos
        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;

        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=admin_Usuarios",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo.", "Error en la operación Ejecutada", true
            );
        }

        if($this->viewData["mode"] == "INS"){
            if (Validators::IsEmpty($this->viewData["useremail"]) || !Validators::IsValidEmail($this->viewData["useremail"])) {
            $this->viewData["error_useremail"][]
            = "Ingrese un Email válido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["username"])) {
            $this->viewData["error_username"][]
            = "El Nombre de Usuario es requerido";
            $hasErrors = true;
            }
    
            if (Validators::IsEmpty($this->viewData["userpswd"]) || !Validators::IsValidPassword($this->viewData["userpswd"])) {
            $this->viewData["error_userpswd"][]
            = "Ingrese contraseña válida (al menos 8 caracteres, 1 número, 1 mayúscula, 1 símbolo especial)";
            $hasErrors = true;
            }
        }


        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {

            case "INS":
                try{
                    if (\Dao\Security\Security::newUsuario($this->viewData["useremail"], $this->viewData["userpswd"], $this->viewData["username"],$this->viewData["usertipo"])) {
                        
                        \Dao\Admin\Usuarios::insertUsuarioRol(\Dao\Security\Security::getUsuarioByEmail($this->viewData["useremail"])["usercod"],$this->viewData["usertipo"]);
                        \Utilities\Site::redirectToWithMsg("index.php?page=admin_usuarios", "¡Usuario Registrado Satisfactoriamente!", "Usuario Registrado", false);
                    }
                } catch (Throwable $ex){
                    echo $ex;
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_usuarios",
                        "No se pudo guardar el nuevo usuario.", "Error en la operación Ejecutada", true
                    );
                }
                break;

            case "UPD":
                $result = Usuarios::updateUsuario(
                    $this->viewData["usercod"],
                    $this->viewData["username"],
                    $this->viewData["userest"],
                    $this->viewData["usertipo"]
                );

                if (!Usuarios::isUsuarioInRol($this->viewData["usercod"], $this->viewData["usertipo"], 'ACT')){
                    if (Usuarios::isUsuarioInRol($this->viewData["usercod"], $this->viewData["usertipo"], 'INA')) {
                        Usuarios::activateUsuarioRol($this->viewData["usercod"], $this->viewData["usertipo"]);
                    }else{
                        Usuarios::insertUsuarioRol($this->viewData["usercod"], $this->viewData["usertipo"]);
                    }
                    Usuarios::disableOthersUsuarioRol($this->viewData["usercod"], $this->viewData["usertipo"]);
                }

                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_Usuarios",
                        "Usuario Actualizado Satisfactoriamente","Usuario Actualizado", false
                    );
                }
            
                break;
            }
        }
    }

    private function processView()
    {
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
            $this->viewData["isInsert"] = true;
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["usercod"],
                $this->viewData["useremail"]
            );
            $this->viewData["userestArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    "value",
                    "text",
                    "value",
                    $this->viewData["userest"]
                );
            $this->viewData["usertipoArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrTipoUsuario,
                    "value",
                    "text",
                    "value",
                    $this->viewData["usertipo"]
                );
            
            if ($this->viewData["usertipo"]  == "SPU"){
                $this->viewData["readonlyEmail"] = true;
                $this->viewData["readonly"] = true; 
                $this->viewData["isSuperUser"] = true; 
                $this->viewData["showBtn"] = false;
            }

            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
                $this->viewData["readonlyEmail"] = true;
                $this->viewData["isInsert"] = false;
            }

            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonlyEmail"] = true;
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
                $this->viewData["isInsert"] = false;

            }
        }

        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}

      