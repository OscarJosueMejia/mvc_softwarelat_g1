<?php
namespace Controllers\Admin;

use Controllers\PublicController;
use Views\Renderer;

class Producto extends PublicController
{
    public function run() :void
    {

        Renderer::render('productos/producto', array());
    }
}
?>
