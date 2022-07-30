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
      use Dao\Mnt\Productos;

      /**
       * Producto
       *
       * @category Public
       * @package  Controllers\Admin;
       * @author   
       * @license  MIT http://
       * @link     http://
       */
    class Producto extends PublicController
    {
      private $viewData = array();
      private $arrModeDesc = array();
      //private $arrEstados = array(); Descomentar en caso que la tabla tenga estados

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
        Renderer::render("productos/Producto", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["invPrdId"] = "";
        $this->viewData["invPrdName"] = "";
        $this->viewData["invPrdDsc"] = "";
        $this->viewData["invPrd"] = "";
        $this->viewData["invPrdPrice"] = "";
        $this->viewData["invPrdImg"] = "";

        $this->viewData["error_invPrdName"] = array();
        $this->viewData["error_invPrdDsc"] = array();
        $this->viewData["error_invPrdCat"] = array();
        $this->viewData["error_invPrdEst"] = array();
        $this->viewData["error_invPrd"] = array();
        $this->viewData["error_invPrdPrice"] = array();
        $this->viewData["error_invPrdImg"] = array();

        $this->viewData["invPrdEst"] = "";
        $this->viewData["invPrdEstArr"] = array();
        $this->viewData["invPrdCat"] = "";
        $this->viewData["invPrdCatArr"] = array();
      
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Producto",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array( 
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );
        $this->viewData["invPrdEstArr"] = $this->arrEstados;

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: (Producto) Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=productos_Productos",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["invPrdId"] = intval($_GET["id"]);
            $tmpProductos = Productos::getById($this->viewData["invPrdId"]);
            error_log(json_encode($tmpProductos));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpProductos, $this->viewData);
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
                "index.php?page=productos_Productos",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["invPrdName"])) {
            $this->viewData["error_invPrdName"][]
             = "El invPrdName es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrdDsc"])) {
            $this->viewData["error_invPrdDsc"][]
             = "El invPrdDsc es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrdCat"])) {
            $this->viewData["error_invPrdCat"][]
             = "El invPrdCat es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrdEst"])) {
            $this->viewData["error_invPrdEst"][]
             = "El invPrdEst es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrd"])) {
            $this->viewData["error_invPrd"][]
             = "El invPrd es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrdPrice"])) {
            $this->viewData["error_invPrdPrice"][]
             = "El invPrdPrice es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["invPrdImg"])) {
            $this->viewData["error_invPrdImg"][]
             = "El invPrdImg es requerido";
            $hasErrors = true;
    }



        
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case "INS":
                $result = Productos::insert(
                    $this->viewData["invPrdName"],
                    $this->viewData["invPrdDsc"],
                    $this->viewData["invPrdCat"],
                    $this->viewData["invPrdEst"],
                    $this->viewData["invPrd"],
                    $this->viewData["invPrdPrice"],
                    $this->viewData["invPrdImg"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=productos_Productos",
                            "Producto Guardado Satisfactoriamente!"
                        );
                }
                break;
            case "UPD":
                $result = Productos::update(
                  $this->viewData["invPrdId"],
                  $this->viewData["invPrdName"],
                  $this->viewData["invPrdDsc"],
                  $this->viewData["invPrdCat"],
                  $this->viewData["invPrdEst"],
                  $this->viewData["invPrd"],
                  $this->viewData["invPrdPrice"],
                  $this->viewData["invPrdImg"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=productos_Productos",
                        "Producto Actualizado Satisfactoriamente"
                    );
                }
                break;
            case "DEL":
                $result = Productos::delete(
                    intval($this->viewData["invPrdId"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=productos_Productos",
                        "Producto Eliminado Satisfactoriamente"
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
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["invPrdId"],
                $this->viewData["invPrdName"]
            );
            $this->viewData["invPrdEstArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    "value",
                    "text",
                    "value",
                    $this->viewData["invPrdEst"]
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

      