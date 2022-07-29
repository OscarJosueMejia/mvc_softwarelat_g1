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
      use Dao\Mnt\Categorias;

      /**
       * Categoria
       *
       * @category Public
       * @package  Controllers\Admin;
       * @author   
       * @license  MIT http://
       * @link     http://
       */
    class Categoria extends PublicController
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
        Renderer::render("productos/Categoria", $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["catid"] = "";
        $this->viewData["catnom"] = "";
        $this->viewData["catest"] = "";
        $this->viewData["catestArr"] = array();

        $this->viewData["error_catnom"] = array();
        $this->viewData["error_catest"] = array();

        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Categoria",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

         $this->arrEstados = array(
             array("value" => "ACT", "text" => "Activo"),
             array("value" => "INA", "text" => "Inactivo"),
         );

         $this->viewData["catestArr"] = $this->arrEstados;

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log("Error: (Categoria) Mode solicitado no existe.");
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=productos_Categorias",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["catid"] = intval($_GET["id"]);
            $tmpCategorias = Categorias::getById($this->viewData["catid"]);
            error_log(json_encode($tmpCategorias));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpCategorias, $this->viewData);
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
                "index.php?page=productos_Categorias",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["catnom"])) {
            $this->viewData["error_catnom"][] = "El catnom es requerido";
            $hasErrors = true;
            }

            if (Validators::IsEmpty($this->viewData["catest"])) {
            $this->viewData["error_catest"][] = "El catest es requerido";
            $hasErrors = true;
        }

        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case "INS":
                $result = Categorias::insert(
                    $this->viewData["catnom"],
            $this->viewData["catest"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=productos_Categorias",
                            "Categoria Guardado Satisfactoriamente!"
                        );
                }
                break;
            case "UPD":
                $result = Categorias::update(
                  $this->viewData["catid"],
                $this->viewData["catnom"],
                $this->viewData["catest"]
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=productos_Categorias",
                        "Categoria Actualizado Satisfactoriamente"
                    );
                }
                break;
            case "DEL":
                $result = Categorias::delete(
                    intval($this->viewData["catid"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=productos_Categorias",
                        "Categoria Eliminado Satisfactoriamente"
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
                $this->viewData["catid"],
                $this->viewData["catnom"]
            );
          $this->viewData["catestArr"]
              = \Utilities\ArrUtils::objectArrToOptionsArray(
                  $this->arrEstados,
                  "value",
                  "text",
                  "value",
                  $this->viewData["catest"]
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
