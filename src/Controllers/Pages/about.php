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
 * About Controller
 *
 * @category Public
 * @package  Controllers
 * @author   
 * @license  MIT http://
 * @link     http://
 */
class About extends PublicController
{
    /**
     * About run method
     *
     * @return void
     */
    public function run() :void
    {
        $viewData = array();
        \Views\Renderer::render("pages/about", $viewData);
    }
}
?>
