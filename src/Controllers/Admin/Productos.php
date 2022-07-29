<?php
namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

class Productos extends PublicController
{
    public function run() :void
    {

        Renderer::render('productos/productos', array());
    }
}
?>
