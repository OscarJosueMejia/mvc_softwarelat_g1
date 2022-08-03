<?php
namespace Controllers\Admin;

use Dao\Admin\Productos as DaoProductos;
use Views\Renderer;

class Productos extends \Controllers\PrivateController
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // $userInRole = \Utilities\Security::isInRol(
        //     \Utilities\Security::getUserId(),
        //     "ADMIN"
        // );
        parent::__construct();
    }

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
