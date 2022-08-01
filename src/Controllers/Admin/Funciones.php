<?php 
namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Admin\Funciones as DaoFunciones;
use Views\Renderer;

class Funciones extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $viewData["Funciones"] = DaoFunciones::getAll();
        
        Renderer::render("admin/funciones", $viewData);
    }
}
