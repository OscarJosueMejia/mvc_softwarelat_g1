<?php 
/**
 * @author: Oscar Mejia
 */
namespace Dao\Admin;
use Dao\Table;

class Roles extends Table {

    public static function getAll(){
        $sqlstr = "select * from `roles`;";  
        return self::obtenerRegistros($sqlstr, array());
    }


    public static function getById($rolescod){
        $sqlstr = "SELECT * from `roles` where rolescod=:rolescod;";
        $sqlParams = array("rolescod" => $rolescod);
        
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }


    public static function insert(
        $rolescod,
        $rolesdsc,
        $rolesest,     
    ){
        $sqlstr = "INSERT INTO `roles` (`rolescod`,`rolesdsc`,`rolesest`)
        VALUES(:rolescod,:rolesdsc,:rolesest);";
        
        $sqlParams =[
        "rolescod" => $rolescod,
        "rolesdsc" => $rolesdsc,
        "rolesest" => $rolesest,
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function update(
        $rolesdsc,
        $rolesest,
        $rolescod 
    ){

        $sqlstr = "UPDATE `roles` SET
        `rolesdsc` = :rolesdsc, `rolesest` = :rolesest
        where `rolescod`=:rolescod;";


        $sqlParams =[
        "rolesdsc" => $rolesdsc,
        "rolesest" => $rolesest,
        "rolescod" => $rolescod
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    public static function delete($rolescod){
        $sqlstr = "UPDATE `roles` set `rolesest` = `INA` where rolescod=:rolescod;";

        $sqlParams = [
        "rolescod" => $rolescod
        ];

        try {
            return self::executeNonQuery($sqlstr, $sqlParams);
        } catch (\Throwable $th) {
            echo "<h2 style='color:red;'>ERROR: No se puede eliminar este registro.</h2>"."\n"."$th";
            die;
        }
    }
}