<?php
namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Security\Security as DaoSecurity;
use Views\Renderer;

class Usuarios extends PublicController
{
    public function run():void
    {
        // code
        $viewData = array();
        $viewData["Usuarios"] = DaoSecurity::getUsuarios();
        error_log(json_encode($viewData));
    
        Renderer::render("admin/usuarios", $viewData);
    }
}

?>
