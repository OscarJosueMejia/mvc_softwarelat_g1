<?php
namespace Controllers\Sec;
class PasswordChange extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $txtPswd = "";
    private $txtPswdNew = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $isAdmin = false;
    private $hasError = false;

    public function run() :void
    {

        if (\Utilities\Security::isInRol(\Utilities\Security::getUserId(), "ADM") || \Utilities\Security::isInRol(\Utilities\Security::getUserId(), "SPU")) {
            $this->isAdmin = true;
        }else{
            $this->isAdmin = false;
        }

        if ($this->isPostBack()) {
            $this->txtEmail = \Utilities\Security::getUser()["userEmail"];
            
                $this->txtPswd = $_POST["txtPswdNew"];
                $this->txtPswdNew = $_POST["txtPswdConf"];
                $this->txtContrActual = $_POST["txtContrActual"];

                if($this->txtPswd != $this->txtPswdNew){
                    $this->generalError = "¡Las contraseñas no coinciden!";
                    $this->hasError = true;
                }
    
                if (! $this->hasError) {
                    if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                        
                        if ($dbUser["userest"] != \Dao\Security\Estados::ACTIVO) {
                            $this->generalError = "¡Credenciales son incorrectas!";
                            $this->hasError = true;
                            error_log(
                                sprintf(
                                    "ERROR: %d %s tiene cuenta con estado %s",
                                    $dbUser["usercod"],
                                    $dbUser["useremail"],
                                    \Dao\Security\Estados::ACTIVO
                                )
                            );
                        }

                        if (!\Dao\Security\Security::verifyPassword($this->txtContrActual, $dbUser["userpswd"])) {
                            $this->generalError = "¡Credenciales son incorrectas!";
                            $this->hasError = true;
                            error_log(
                                sprintf(
                                    "ERROR: %d %s contraseña incorrecta",
                                    $dbUser["usercod"],
                                    $dbUser["useremail"]
                                )
                            );
                        }
    
                        if (! $this->hasError) {
                            try {
                                \Dao\Security\Security::updateUsuario(
                                    $this->txtEmail,
                                    $dbUser["username"],
                                    $this->txtPswdNew,
                                    \Dao\Security\Estados::ACTIVO,
                                    $dbUser["usertipo"],
                                );
                                \Utilities\Site::redirectToWithMsg(
                                    "index.php?page=pages_infouser",
                                    "Contraseña Actualizada Satisfactoriamente",
                                    "Operación Ejecutada Correctamente",
                                    false
                                );
                            } catch (\Throwable $th) {
                                error_log($th);
                            }
                        }
    
                    } else {
                        $this->generalError = "¡Credenciales son incorrectas!";
                    }
                }
        }
        $dataView = get_object_vars($this);

        if($this->isAdmin){
            \Views\Renderer::render("security/passchangeadmin", $dataView);
        }else{
            \Views\Renderer::render("security/passchangepublic", $dataView);
        }
    }
}

?>
