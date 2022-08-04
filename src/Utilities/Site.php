<?php

namespace Utilities;

class Site
{
    public static function configure()
    {
        $donenv = new \Utilities\DotEnv("parameters.env");
        \Utilities\Context::setArrayToContext($donenv->load());
        date_default_timezone_set(\Utilities\Context::getContextByKey("TIMEZONE"));
    }
    public static function getPageRequest()
    {
        $pageRequest = "index";
        if (\Utilities\Security::isLogged()) {
            // $pageRequest = "admin\\admin";
            $pageRequest = "index";
        }
        if (isset($_GET["page"])) {
            $pageRequest = str_replace(array("_", "-", "."), "\\", $_GET["page"]);
        }
        Context::setArrayToContext($_GET);
        Context::setContext("request_uri", $_SERVER["REQUEST_URI"]);
        return "Controllers\\" . $pageRequest;
        //  \\Controllers\\rpts\\reportusers 
    }
    public static function redirectTo($url)
    {
        if (Context::getContextByKey("USE_URLREWRITE") == "1") {
            header("Location:" . \Views\Renderer::rewriteUrl($url));
        } else { 
            header("Location:" . $url);
        }
        
        die();
    }
    public static function redirectToWithMsg($url, $msg, $title, $isError)
    {
        $img = "https://cemesablobstorage.blob.core.windows.net/blobsimg/checked.png";

        if ($isError) {
            $img = "https://cemesablobstorage.blob.core.windows.net/blobsimg/error.png";
        }

        $html = "<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css' integrity='sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N' crossorigin='anonymous'> <script src='https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js' integrity='sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj' crossorigin='anonymous'></script> <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct' crossorigin='anonymous'></script> <script> $(document).ready(function () { $('#staticBackdrop').modal('show'); }); </script> <div style='background-color: whitesmoke;' class='modal fade' id='staticBackdrop' data-backdrop='static' data-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'> <div class='modal-dialog'> <div class='modal-content'> <div class='modal-header'> <h5 class='modal-title' id='staticBackdropLabel'>".$title."</h5> </div> <img style='width: 90px;margin: auto;' class='mt-4' src='".$img."' alt='check-icon'> <div class='modal-body'><p class='text-center mt-3'> ".$msg. "</p> </div> <div class='modal-footer'> <button type='button' class='btn btn-secondary' id='btnClose'>Cerrar</button> </div> </div> </div> </div>  <script>$('#btnClose').click(()=>{window.location.assign('".$url."');})</script>";
        
        echo $html;

        die();
    }
    public static function addLink($href)
    {
        $tmpLinks = \Utilities\Context::getContextByKey("SiteLinks");
        if ($tmpLinks === "") {
            $tmpLinks = array($href);
        } else {
            $tmpLinks[] = $href;
        }
        \Utilities\Context::setContext("SiteLinks", $tmpLinks);
    }
    public static function addBeginScript($src)
    {
        $tmpSrcs = \Utilities\Context::getContextByKey("BeginScripts");
        if ($tmpSrcs === "") {
            $tmpSrcs = array($src);
        } else {
            $tmpSrcs[] = $src;
        }
        \Utilities\Context::setContext("BeginScripts", $tmpSrcs);
    }
    public static function addEndScript($src)
    {
        $tmpSrcs = \Utilities\Context::getContextByKey("EndScripts");
        if ($tmpSrcs === "") {
            $tmpSrcs = array($src);
        } else {
            $tmpSrcs[] = $src;
        }
        \Utilities\Context::setContext("EndScripts", $tmpSrcs);
    }
}
?>
