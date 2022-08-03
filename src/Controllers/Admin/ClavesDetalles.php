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
      use Dao\Admin\ClavesDetalles as DaoClavesDetalles;
      use Views\Renderer;
      
      /**
       * ClavesDetalles
       *
       * @category Public
       * @package  Controllers\Admin;
       * @author
       * @license  MIT http://
       * @link     http://
       */
      class ClavesDetalles extends PublicController
      {
          /**
           * Runs the controller
           *
           * @return void
           */
          public function run():void
          {
              // code
              $viewData = array();
              $viewData["CanInsert"] = true;
              $viewData["CanUpdate"] = true;
              $viewData["CanDelete"] = true;
              $viewData["CanView"] = true;
              $viewData["Delete"] = true;
              $viewData["Update"] = true;

            if (!$this->isPostBack()) {
                if(isset($_GET["id"])) {
                    $invPrdId = intval($_GET["id"]);
                    $opt = intval($_GET["opt"]);
                    $viewData["invPrdId"] = $invPrdId;
                    $viewData["opt"] = $opt;
                    $viewData["ClavesDetalles"] = DaoClavesDetalles::getAll($invPrdId, $opt);
                  }else{
                    \Utilities\Site::redirectTo("index.php?page=admin_ClavesProductos");
                  }
             }

             if($opt == 2){
                $viewData["Update"] = true;
                $viewData["Delete"] = false;
             }elseif($opt == 3){
                $viewData["Delete"] = false;
                $viewData["Update"] = false;
             }
              error_log(json_encode($viewData));
              Renderer::render("admin/ClavesDetalles", $viewData);
          }
      }

?>
