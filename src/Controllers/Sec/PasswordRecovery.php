<?php
namespace Controllers\Sec;
class PasswordRecovery extends \Controllers\PublicController
{
    private $txtEmail = "";
    private $intStep = 0;
    private $txtPswdTemp = "";
    private $txtPswdNew = "";
    private $errorEmail = "";
    private $errorPswd = "";
    private $generalError = "";
    private $hasError = false;

    public function run() :void
    {
        if ($this->isPostBack()) {
            $this->txtEmail = $_POST["txtEmail"];
            $this->intStep = $_POST["intStep"];


            if ($this->intStep == 1) {
                if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                    $this->errorEmail = "¡Correo no tiene el formato adecuado!";
                    $this->hasError = true;
                }
    
                if (! $this->hasError) {
                    if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                        
                        if ($dbUser["userest"] != \Dao\Security\Estados::BLOQUEADO && $dbUser["userest"] != \Dao\Security\Estados::ACTIVO ) {
                            $this->generalError = "¡Credenciales son incorrectas!";
                            $this->intStep == 0;
                            $this->hasError = true;
                            error_log(
                                sprintf(
                                    "ERROR: %d %s tiene cuenta con estado %s",
                                    $dbUser["usercod"],
                                    $dbUser["useremail"],
                                    $dbUser["userest"]
                                )
                            );
                        }
    
                        if (! $this->hasError) {
                            try {
                                $tempPass = \Dao\Security\Security::randomPassword(8);
                                
                                \Dao\Security\Security::updateUsuario(
                                    $this->txtEmail,
                                    $dbUser["username"],
                                    $tempPass,
                                    \Dao\Security\Estados::BLOQUEADO,
                                    $dbUser["usertipo"],
                                );

                                if (!\Utilities\EmailSender::sendMail($dbUser["useremail"], $tempPass)) {
                                    $this->generalError = "Error al Enviar el Correo de Recuperación";
                                    $this->intStep == 0;
                                }
                            } catch (\Throwable $th) {
                                echo "<br><br><br><br>";
                                echo $th;
                            }
                        }
    
                    } else {
                        error_log(
                            sprintf(
                                "ERROR: %s trato de enviar un código de recuperación",
                                $this->txtEmail
                            )
                        );
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->intStep == 0;
                    }
                }

            }elseif($this->intStep == 2){
                $this->txtPswdTemp = $_POST["txtPswdTemp"];
                $this->txtPswdNew = $_POST["txtPswdNew"];

                if (!\Utilities\Validators::IsValidEmail($this->txtEmail)) {
                    $this->errorEmail = "¡Correo no tiene el formato adecuado!";
                    $this->hasError = true;
                }
    
                if (! $this->hasError) {
                    if ($dbUser = \Dao\Security\Security::getUsuarioByEmail($this->txtEmail)) {
                        
                        if ($dbUser["userest"] != \Dao\Security\Estados::BLOQUEADO) {
                            $this->generalError = "¡Credenciales son incorrectas!";
                            $this->hasError = true;
                            error_log(
                                sprintf(
                                    "ERROR: %d %s tiene cuenta con estado %s",
                                    $dbUser["usercod"],
                                    $dbUser["useremail"],
                                    \Dao\Security\Estados::BLOQUEADO
                                )
                            );
                        }

                        if (!\Dao\Security\Security::verifyPassword($this->txtPswdTemp, $dbUser["userpswd"])) {
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
                                \Utilities\Site::redirectTo("index.php?page=sec_login");
                            } catch (\Throwable $th) {
                                echo "<br><br><br><br>";
                                echo $th;
                            }
                        }else{
                            $this->intStep == 2;
                        }
    
                    } else {
                        error_log(
                            sprintf(
                                "ERROR: %s trato de enviar un código de recuperación",
                                $this->txtEmail
                            )
                        );
                        $this->generalError = "¡Credenciales son incorrectas!";
                        $this->intStep == 2;
                    }
                }
            }
        }
        $dataView = get_object_vars($this);

        if ($this->intStep == 1 || $this->intStep == 2) {
            \Views\Renderer::render("security/passchange", $dataView);
        }else{
            \Views\Renderer::render("security/passrecovery", $dataView);
        }

    }
}

?>
