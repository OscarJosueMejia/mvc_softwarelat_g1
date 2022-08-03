<?php 
namespace Controllers\Admin;

use Dao\Admin\Funciones as DaoFunciones;
use Views\Renderer;

class Funciones extends \Controllers\PrivateController
{
    public function run():void
    {
        $viewData = array();
        $viewData["Funciones"] = DaoFunciones::getAll();
        
    // \Utilities\Security::isInRol();
        $viewData["CanInsert"] = true;
        $viewData["CanUpdate"] = true;
        $viewData["CanDelete"] = true;
        $viewData["CanView"] = true;

        Renderer::render("admin/funciones", $viewData);
    }
}
