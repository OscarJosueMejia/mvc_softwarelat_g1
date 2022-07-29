<?php
namespace Controllers\Admin;

use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

class Productos extends PublicController
{
    public function run() :void
    {
        $viewData = array();
        $viewData["Productos"] = [
            ["invPrdId" => "1",
            "invPrdName" => "Microsoft Office 2021 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "400.00",],
            ["invPrdId" => "2",
            "invPrdName" => "Microsoft Office 2019 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "350.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2016 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "300.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2016 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "300.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2010 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "300.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2015 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "700.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2014 PA",
            "invPrdCat" => "Software",
            "invPrdPrice" => "700.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2016 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "800.00",],
            ["invPrdId" => "3",
            "invPrdName" => "Microsoft Office 2018 PA",
            "invPrdCat" => "Ofimatica",
            "invPrdPrice" => "900.00",]
        ];
        $viewData["CanInsert"] = true;
        $viewData["CanUpdate"] = true;
        $viewData["CanDelete"] = true;
        $viewData["CanView"] = true;
        
        Renderer::render('productos/productos', $viewData);
    }
}
?>
