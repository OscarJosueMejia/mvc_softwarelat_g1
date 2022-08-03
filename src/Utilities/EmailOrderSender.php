<?php

namespace Utilities;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

class EmailOrderSender {
    public static function sendMail($target, $emailHtml){
        try {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);
    
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = \Utilities\Context::getContextByKey("SMTP_HOST");                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = \Utilities\Context::getContextByKey("SMTP_USER");                      //SMTP username
            $mail->Password   = \Utilities\Context::getContextByKey("SMTP_SECRET");                               //SMTP password
            $mail->SMTPSecure = "tls"; //Enable implicit TLS encryption           
            $mail->Port       = \Utilities\Context::getContextByKey("SMTP_PORT");;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(\Utilities\Context::getContextByKey("SMTP_USER"), 'Softwarelat Honduras');
            $mail->addAddress($target); //Name is optional
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Detalle de Orden de Compra';
            $mail->Body    = $emailHtml;
        
            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
