<?php 
/**
 * @author: Oscar Mejia
 */

namespace Controllers\Admin;

use Dao\Admin\Roles as DaoRoles;
use Views\Renderer;

class Roles extends \Controllers\PrivateController
{
    public function run():void
    {
        $viewData = array();
        $viewData["Roles"] = DaoRoles::getAll();
        
        Renderer::render("admin/roles", $viewData);
    }
}
