<?php
namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Admin\Productos as DaoProductos;
use Views\Renderer;

class Productos extends PublicController
{
    public function run() :void
    {
        $viewData = array();
        $viewData["Productos"] = DaoProductos::getAll();
        $viewData["CanInsert"] = true;
        $viewData["CanUpdate"] = true;
        $viewData["CanDelete"] = true;
        $viewData["CanView"] = true;
        
        Renderer::render('admin/productos', $viewData);
    }
}
?>
