<?php 
/**
 * @author: Oscar Mejia
 */

namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Admin\Roles as DaoRoles;
use Views\Renderer;

class Roles extends PublicController
{
    public function run():void
    {
        $viewData = array();
        $viewData["Roles"] = DaoRoles::getAll();
        
        Renderer::render("admin/roles", $viewData);
    }
}
