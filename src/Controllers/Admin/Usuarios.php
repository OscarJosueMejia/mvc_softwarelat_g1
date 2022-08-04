<?php
namespace Controllers\Admin;

use Dao\Security\Security as DaoSecurity;
use Views\Renderer;

class Usuarios extends \Controllers\PrivateController
{
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Usuarios"] = DaoSecurity::getUsuarios();
    
        $isAuthorized = \Utilities\Security::isInRol(\Utilities\Security::getUserId(), 'SPU');
        
        $viewData["CanInsert"] = $isAuthorized ? true:false;
        $viewData["CanUpdate"] = $isAuthorized ? true:false;
        $viewData["CanDelete"] = $isAuthorized ? true:false;
        $viewData["CanView"] = $isAuthorized ? true:false;


        Renderer::render("admin/usuarios", $viewData);
    }
}

?>
