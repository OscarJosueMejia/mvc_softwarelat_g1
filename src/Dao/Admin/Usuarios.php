<?php

namespace Dao\Admin;

use Dao\Table;

class Usuarios extends Table
{

    /**
     * Update User Details
     *
     * @param [int] $usercod Current User Code
     * @param [char] $userest New User Status
     * @param [char] $usertipo New User Tipo
     * @return void
     */
    public static function updateUsuario($usercod, $userest, $usertipo) {
        $sqlstr = "UPDATE `usuario` SET 
        `userest`=:userest, `usertipo`=:usertipo 
        where `usercod` =:usercod;";
        
        $sqlParams = [
            "userest" => $userest,
            "usertipo" => $usertipo,
            "usercod" => $usercod,
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    static public function getUsuarioById($usercod)
    {
        $sqlstr = "SELECT * from `usuario` where `usercod` = :usercod ;";
        $params = array("usercod"=>$usercod);

        return self::obtenerUnRegistro($sqlstr, $params);
    }

    
}
