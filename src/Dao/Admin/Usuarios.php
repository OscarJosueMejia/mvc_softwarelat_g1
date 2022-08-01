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

    public static function isUsuarioInRol($usercod, $rolescod, $roleuserest)
    {
        $sqlstr = "SELECT * from roles_usuarios where usercod =:usercod and rolescod =:rolescod and roleuserest=:roleuserest and roleuserexp > now() limit 1;";
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "usercod" => $usercod,
                "rolescod" => $rolescod,
                "roleuserest" => $roleuserest
            )
        );
        return count($resultados) > 0;
    }

    public static function insertUsuarioRol($usercod, $rolescod){
        $sqlstr = "INSERT INTO `roles_usuarios` (`usercod`,`rolescod`,`roleuserest`,`roleuserfch`,`roleuserexp`)
        VALUES(:usercod,:rolescod,:roleuserest,:roleuserfch,:roleuserexp);";
        
        $sqlParams =[
        "usercod" => $usercod,
        "rolescod" => $rolescod,
        "roleuserest" => 'ACT',
        "roleuserfch" => date('y/m/d h:i:s',time()),
        "roleuserexp" => '2030-12-31 00:00:00',
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    
    public static function activateUsuarioRol($usercod, $rolescod) {
        $sqlstr = "UPDATE `roles_usuarios` SET 
        `roleuserest`='ACT' where `usercod` =:usercod and `rolescod`=:rolescod;";
        
        $sqlParams = [
            "usercod" => $usercod,
            "rolescod" => $rolescod,
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function disableOthersUsuarioRol($usercod, $rolescod) {
        $sqlstr = "UPDATE `roles_usuarios` SET 
        `roleuserest`='INA' where `usercod` =:usercod and `rolescod`<>:rolescod;";
        
        $sqlParams = [
            "usercod" => $usercod,
            "rolescod" => $rolescod,
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
