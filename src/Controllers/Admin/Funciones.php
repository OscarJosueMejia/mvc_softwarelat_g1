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
        
        $isAuthorized = \Utilities\Security::isInRol(\Utilities\Security::getUserId(), 'SPU');
        
        $viewData["CanInsert"] = $isAuthorized ? true:false;
        $viewData["CanUpdate"] = $isAuthorized ? true:false;
        $viewData["CanDelete"] = $isAuthorized ? true:false;
        $viewData["CanView"] = $isAuthorized ? true:false;

        Renderer::render("admin/funciones", $viewData);
    }
}
