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
    
    
    public static function isFeatureInRol($rolescod, $fncod, $fnrolest){
        $sqlstr = "SELECT * from funciones_roles where rolescod=:rolescod and fncod=:fncod and fnrolest=:fnrolest and fnexp > now() limit 1;";  
        $resultados = self::obtenerRegistros(
            $sqlstr,
            array(
                "rolescod" => $rolescod,
                "fncod" => $fncod,
                "fnrolest" => $fnrolest
            )
        );
        return count($resultados) > 0;
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

    public static function insertFeatureInRol($rolescod, $fncod){
        $sqlstr = "INSERT INTO `funciones_roles` (`rolescod`,`fncod`,`fnrolest`,`fnexp`)
        VALUES(:rolescod,:fncod,:fnrolest,:fnexp);";
        
        $sqlParams =[
        "rolescod" => $rolescod,
        "fncod" => $fncod,
        "fnrolest" => 'ACT',
        "fnexp" => '2030-12-31 00:00:00',
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    
    public static function activateFeatureInRol($rolescod, $fncod){
        $sqlstr = "UPDATE `funciones_roles` SET
        `fnrolest` = 'ACT' where `rolescod`=:rolescod and `fncod`=:fncod;";

        $sqlParams =[
        "rolescod" => $rolescod,
        "fncod" => $fncod,
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
        $sqlstr = "UPDATE `roles` set `rolesest` = 'INA' where rolescod=:rolescod;";

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