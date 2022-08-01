<?php
      /**
       * PHP Version 7.2
       * Admin
       *
       * @category Controller
       * @package  Controllers\Admin
       * @author   
       * @license  Comercial http://
       * @version  CVS:1.0.0
       * @link     http://url.com
       */
      namespace Controllers\Admin;

      // ---------------------------------------------------------------
      // Sección de imports
      // ---------------------------------------------------------------
      use Controllers\PublicController;
      use Views\Renderer;
      use Utilities\Validators;
      use Dao\Admin\ClavesDetalles;
      use Dao\Admin\Productos;

      /**
       * ClavesDetalle
       *
       * @category Public
       * @package  Controllers\Admin;
       * @author
       * @license  MIT http://
       * @link     http://
       */
    class ClavesDetalle extends \Controllers\PrivateController
    {
      private $viewData = array();
      private $arrModeDesc = array();
      private $arrEstados = array();
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
        Renderer::render("admin/ClavesDetalle", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["invClvId"] = "";
        $this->viewData["invPrdId"] = "";
        $this->viewData["invClvSerial"] = "";
        $this->viewData["invClvExp"] = "";
        $this->viewData["invClvEst"] = "";

        $this->viewData["error_invPrdId"] = array();
        $this->viewData["error_invClvSerial"] = array();
        $this->viewData["error_invClvExp"] = array();


        $this->viewData["invClvEst"] = "";
        $this->viewData["invClvEstArr"] = array();

        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nueva Clave",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->viewData["invClvEstArr"] = $this->arrEstados;
    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: (ClavesDetalle) Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=admin_ClavesDetalles",
                    "No se puede procesar su solicitud!",
                    "Error en la operación Ejecutada",
                    true
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["invClvId"] = intval($_GET["id"]);
            $tmpClavesDetalles = ClavesDetalles::getById($this->viewData["invClvId"]);
            error_log(json_encode($tmpClavesDetalles));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpClavesDetalles, $this->viewData);
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
                "index.php?page=admin_ClavesDetalles",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo.",
                "Error en la operación Ejecutada",
                true
            );
        }

        if (Validators::IsEmpty($this->viewData["invPrdId"])) {
        $this->viewData["error_invPrdId"][] = "El invPrdId es requerido";
        $hasErrors = true;
        }
        
        if (Validators::IsEmpty($this->viewData["invClvSerial"])) {
        $this->viewData["error_invClvSerial"][]= "El invClvSerial es requerido";
        $hasErrors = true;
        }
        
        if (Validators::IsEmpty($this->viewData["invClvExp"])) {
        $this->viewData["error_invClvExp"][] = "El invClvExp es requerido";
        $hasErrors = true;
        }

        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case "INS":
                $result = ClavesDetalles::insert(
                    $this->viewData["invPrdId"],
                    $this->viewData["invClvSerial"],
                    $this->viewData["invClvExp"],
                    $this->viewData["invClvEst"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=admin_ClavesDetalles",
                            "Clave Guardada Satisfactoriamente!",
                            "Operación Ejecutada Correctamente",
                            false
                        );
                }
                break;
            case "UPD":
                $result = ClavesDetalles::update(
                  $this->viewData["invClvId"],
                  $this->viewData["invPrdId"],
                  $this->viewData["invClvSerial"],
                  $this->viewData["invClvExp"],
                  $this->viewData["invClvEst"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_ClavesDetalles",
                        "Clave Actualizada Satisfactoriamente.",
                        "Operación Ejecutada Correctamente",
                        false
                    );
                }
                break;
            case "DEL":
                $result = ClavesDetalles::delete(
                    intval($this->viewData["invClvId"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=admin_ClavesDetalles",
                        "Clave Eliminada Satisfactoriamente.",
                        "Operación Ejecutada Correctamente",
                        false
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
            $this->viewData["viewState"] = false;
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["invClvId"],
                $this->viewData["invPrdId"]
            );
            $this->viewData["invClvEstArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    "value",
                    "text",
                    "value",
                    $this->viewData["invClvEst"]
                );

            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
                $this->viewData["viewState"] = true;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
                $this->viewData["viewState"] = false;
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
                $this->viewData["viewState"] = true;
            }
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}
