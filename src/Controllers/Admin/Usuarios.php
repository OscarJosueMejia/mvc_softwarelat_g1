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
        error_log(json_encode($viewData));
    
        Renderer::render("admin/usuarios", $viewData);
    }
}

?>
