<?php
/**
 * PHP Version 7.2
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @version  CVS:1.0.0
 * @link     http://
 */
namespace Controllers\Pages;

use Controllers\PublicController;
/**
 * Contact Controller
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class Contact extends PublicController
{
    /**
     * Contact run method
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array();
        \Views\Renderer::render("pages/contact", $viewData);
    }
}
?>
