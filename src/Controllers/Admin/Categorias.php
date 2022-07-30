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
      use Dao\Admin\Categorias as DaoCategorias;
      use Views\Renderer;

      /**
       * Categorias
       *
       * @category Public
       * @package  Controllers\Admin;
       * @author
       * @license  MIT http://
       * @link     http://
       */
      class Categorias extends PublicController
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
              $viewData["Categorias"] = DaoCategorias::getAll();
              $viewData["CanInsert"] = true;
              $viewData["CanUpdate"] = true;
              $viewData["CanDelete"] = true;
              $viewData["CanView"] = true;
              error_log(json_encode($viewData));

              Renderer::render("admin/categorias", $viewData);
          }
      }
?>