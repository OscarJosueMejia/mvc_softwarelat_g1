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
        
        Renderer::render("admin/funciones", $viewData);
    }
}
