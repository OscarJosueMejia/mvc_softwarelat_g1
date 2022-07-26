<?php

namespace Controllers\Sec;

use Controllers\PublicController;
use Dao\Security\UsuarioTipo;
use \Utilities\Validators;
use Exception;
use Throwable;

class Register extends PublicController
{
    private $txtUser = "";
    private $txtEmail = "";
    private $txtPswd = "";
    private $errorUser = "";
    private $errorEmail ="";
    private $errorPswd = "";
    private $hasErrors = false;
    public function run() :void
    {

        if ($this->isPostBack()) {
            $this->txtUser = $_POST["txtUser"];
            $this->txtEmail = $_POST["txtEmail"];
            $this->txtPswd = $_POST["txtPswd"];
            //validaciones
            if (!Validators::IsValidUser($this->txtUser)) {
                $this->errorUser = "Ingrese un usuario adecuado.";
                $this->hasErrors = true;
            }
            if (!(Validators::IsValidEmail($this->txtEmail))) {
                $this->errorEmail = "El correo no tiene el formato adecuado";
                $this->hasErrors = true;
            }
            if (!Validators::IsValidPassword($this->txtPswd)) {
                $this->errorPswd = "La contraseña debe tener al menos 8 caracteres una mayúscula, un número y un caracter especial.";
                $this->hasErrors = true;
            }
            
            if (!$this->hasErrors) {
                try{
                    if (\Dao\Security\Security::newUsuario($this->txtEmail, $this->txtPswd, $this->txtUser, UsuarioTipo::PUBLICO)) {
                        \Dao\Admin\Usuarios::insertUsuarioRol(\Dao\Security\Security::getUsuarioByEmail($this->txtEmail)["usercod"],"PBL");
                        \Utilities\Site::redirectToWithMsg("index.php?page=sec_login", "¡Usuario Registrado Satisfactoriamente!", "Usuario Registrado", false);
                    }
                } catch (Throwable $ex){
                    die($ex);
                }
            }
        }
        $viewData = get_object_vars($this);
        \Views\Renderer::render("security/sigin", $viewData);
    }
}
//$Eck&*re1e
?>
