<?php

      namespace Dao\Admin;

      use Dao\Table;

      /**
       * Modelo de Datos para la tabla de Claves_detalle
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class ClavesDetalles extends Table
      {
          /*
          Tabla a generar:
          invClvId
          invPrdId
          invClvSerial
          invClvExp
          invClvEst

          */
          /**
           * Obtiene todos los registros de ClavesDetalles
           *
           * @return array
           */
          public static function getAll(int $invClvId, int $opt)
          {
            if($opt == 1){
                $sqlstr = "SELECT cd.invClvId, pr.invPrdId, pr.invPrdName, cd.invClvSerial, cd.invClvExp, cd.invClvEst FROM softwarelat_db.claves_detalle cd
                INNER JOIN softwarelat_db.productos pr
                ON cd.invPrdId = pr.invPrdId WHERE pr.invPrdId = :invClvId  AND cd.invClvExp > now() AND cd.invClvEst = 'ACT'";
            }elseif($opt == 2){
                $sqlstr = "SELECT cd.invClvId, pr.invPrdId, pr.invPrdName, cd.invClvSerial, cd.invClvExp, cd.invClvEst FROM softwarelat_db.claves_detalle cd
                INNER JOIN softwarelat_db.productos pr
                ON cd.invPrdId = pr.invPrdId WHERE pr.invPrdId = :invClvId AND (cd.invClvExp < now() OR cd.invClvEst = 'INA')";
            }elseif($opt == 3){
                $sqlstr = "SELECT cd.invClvId, pr.invPrdId,  pr.invPrdName, cd.invClvSerial, cd.invClvExp, cd.invClvEst FROM softwarelat_db.claves_detalle cd
                INNER JOIN softwarelat_db.productos pr
                ON cd.invPrdId = pr.invPrdId WHERE pr.invPrdId = :invClvId AND cd.invClvEst = 'VEN'";
            }
            $sqlParams = array("invClvId" => $invClvId);
            return self::obtenerRegistros($sqlstr, $sqlParams);
          }

          /**
           * Get ClavesDetalles By Id
           *
           * @param int $invClvId Codigo del ClavesDetalles
           *
           * @return array
           */
          public static function getById(int $invClvId, int $invPrdId)
          {
              $sqlstr = "SELECT cd.invClvId, pr.invPrdName, pr.invPrdId, cd.invClvSerial, cd.invClvExp, cd.invClvEst FROM softwarelat_db.claves_detalle cd
                         INNER JOIN softwarelat_db.productos pr ON cd.invPrdId = pr.invPrdId WHERE pr.invPrdId = :invPrdId AND cd.invClvId = :invClvId";
              $sqlParams = array("invClvId" => $invClvId, "invPrdId" => $invPrdId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }

          /**
           * Get ClavesDetalles By Id for Insert
           *
           * @param int $invClvId Codigo del ClavesDetalles
           *
           * @return array
           */
          public static function getByIdForInsert(int $invPrdId)
          {
              $sqlstr = "SELECT pr.invPrdName, pr.invPrdId FROM 
                  softwarelat_db.productos pr WHERE pr.invPrdId = :invPrdId AND pr.invPrdEst = 'ACT'";
              $sqlParams = array("invPrdId" => $invPrdId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }

          /**
           * Insert into ClavesDetalles
           */
      
          public static function insert(
            $invPrdId,
            $invClvSerial,
          ){
            try {
              $textoClaveArr = array();
              $textoClaveArr = (explode(",",$invClvSerial));
              foreach ($textoClaveArr as $value) {
                $sqlstr = "INSERT INTO `claves_detalle`
                   (`invPrdId`, `invClvSerial`, `invClvExp`, `invClvEst`)
                   VALUES
                   (:invPrdId, :invClvSerial, date_add(now(), INTERVAL 30 DAY),'ACT'); ";
                $sqlParams = [
                    "invPrdId" => $invPrdId,
                    "invClvSerial" => $value,
                ];
                self::executeNonQuery($sqlstr, $sqlParams);
              }
              return true;
            } catch (\Throwable $th) {
              return error_log($th);
            }
            
          }
          /**
           * Updates ClavesDetalles
           */
          public static function update(
            $invClvId,
            $invPrdId,
            $invClvSerial,
            $invClvExp,
            $invClvEst,
            $goingtoUPDdate
          ){  if($goingtoUPDdate == 0){
              $sqlstr = "UPDATE `claves_detalle` set
              `invPrdId`=:invPrdId,
              `invClvSerial`=:invClvSerial,
              `invClvEst`=:invClvEst
             where `invClvId` =:invClvId;";
              $sqlParams = [
                "invClvId" => $invClvId,
                "invPrdId" => $invPrdId,
                "invClvSerial" => $invClvSerial,
                "invClvEst" => $invClvEst
              ];  
            }elseif($goingtoUPDdate == 1){
                $sqlstr = "UPDATE `claves_detalle` set
              `invPrdId`=:invPrdId,
              `invClvSerial`=:invClvSerial,
              `invClvExp` = date_add(now(), INTERVAL 30 DAY),
              `invClvEst`=:invClvEst
             where `invClvId` =:invClvId;";
              $sqlParams = [
                "invClvId" => $invClvId,
                "invPrdId" => $invPrdId,
                "invClvSerial" => $invClvSerial,
                "invClvEst" => $invClvEst
              ];
            }
              return self::executeNonQuery($sqlstr, $sqlParams);

          }

          /**
           * Undocumented function
           *
           * @param [type] $invClvId Codigo del ClavesDetalles
           *
           * @return void
           */
          public static function delete($invClvId)
          {
              $sqlstr = "UPDATE `claves_detalle` set `invClvEst`=:invClvEst where `invClvId`= :invClvId";
              $sqlParams = array(
                  "invClvId" => $invClvId,
                  "invClvEst" => "INA"
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      }
?>