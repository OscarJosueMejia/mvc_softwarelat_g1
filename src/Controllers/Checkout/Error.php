<?php

namespace Controllers\Checkout;

use Controllers\PublicController;
class Error extends PublicController
{
    public function run(): void
    {
        $title = "Ha ocurrido un error al procesar su orden. 🙁";
        $msg = "Si tiene más problemas o inconvenientes no dude en contactar nuestro servicio al cliente.";
        echo "
            <!DOCTYPE html><html lang='es'><head><meta charset='utf-8'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta name='viewport' content='width=device-width, initial-scale=1'><link rel='icon' href='https://cemesablobstorage.blob.core.windows.net/blobsimg/favicon.png' type='image/x-icon'><title>Error | Softwarelat</title><link href='https://fonts.googleapis.com/css?family=Montserrat:400,700,900' rel='stylesheet'><style>*{-webkit-box-sizing: border-box;box-sizing: border-box;}body{padding: 0;margin: 0;}#notfound{position: relative;height: 100vh;}#notfound .notfound{position: absolute;left: 50%;top: 50%;-webkit-transform: translate(-50%, -50%);-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);}.notfound{max-width: 410px;width: 100%;text-align: center;}.notfound .notfound-404{height: 280px;position: relative;z-index: -1;}.notfound .notfound-404 h1{font-family: 'Montserrat', sans-serif;font-size: 230px;margin: 0px;font-weight: 900;position: absolute;left: 50%;-webkit-transform: translateX(-50%);-ms-transform: translateX(-50%);transform: translateX(-50%);background: url(https://cemesablobstorage.blob.core.windows.net/blobsimg/bg.jpg) no-repeat;-webkit-background-clip: text;-webkit-text-fill-color: transparent;background-size: cover;background-position: center;}.notfound h2{font-family: 'Montserrat', sans-serif;color: #000;font-size: 24px;font-weight: 700;text-transform: uppercase;margin-top: 0;}.notfound p{font-family: 'Montserrat', sans-serif;color: #000;font-size: 14px;font-weight: 400;margin-bottom: 20px;margin-top: 0px;}.notfound a{font-family: 'Montserrat', sans-serif;font-size: 14px;text-decoration: none;text-transform: uppercase;background: #443a54;display: inline-block;padding: 15px 30px;border-radius: 40px;color: #fff;font-weight: 700;-webkit-box-shadow: 0px 4px 15px -5px #443a54;box-shadow: 0px 4px 15px -5px #443a54;}.notfound a:hover{background: #6a5d7e;}@media only screen and (max-width: 767px){.notfound .notfound-404{height: 142px;}.notfound .notfound-404 h1{font-size: 112px;}}</style></head><body><div id='notfound'><div class='notfound'><div class='notfound-404'><h1>Oops!</h1></div><h2>".$title."</h2><p>".$msg."</p><a href='index.php?page=orders_cartItems'>Ir Al Inicio</a></div></div></body></html>
        ";
        die();
    }
}

?>
