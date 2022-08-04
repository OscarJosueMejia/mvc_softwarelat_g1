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
        
        $isAuthorized = \Utilities\Security::isInRol(\Utilities\Security::getUserId(), 'SPU');
        
        $viewData["CanInsert"] = $isAuthorized ? true:false;
        $viewData["CanUpdate"] = $isAuthorized ? true:false;
        $viewData["CanDelete"] = $isAuthorized ? true:false;
        $viewData["CanView"] = $isAuthorized ? true:false;

        
        Renderer::render("admin/roles", $viewData);
    }
}
