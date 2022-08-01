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
          public static function getAll()
          {
              $sqlstr = "Select * from claves_detalle;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get ClavesDetalles By Id
           *
           * @param int $invClvId Codigo del ClavesDetalles
           *
           * @return array
           */
          public static function getById(int $invClvId)
          {
              $sqlstr = "SELECT * from `claves_detalle` where invClvId=:invClvId;";
              $sqlParams = array("invClvId" => $invClvId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into ClavesDetalles
           */
          public static function insert(
            $invPrdId,
            $invClvSerial,
            $invClvExp,
            $invClvEst
          ) {
              $sqlstr = "INSERT INTO `claves_detalle`
                 (`invPrdId`,
                  `invClvSerial`,
                  `invClvExp`,
                  `invClvEst`)
                 VALUES
                 (:invPrdId,
                  :invClvSerial,
                  :invClvExp,
                  :invClvEst); ";
              $sqlParams = [
                  "invPrdId" => $invPrdId,
                  "invClvSerial" => $invClvSerial,
                  "invClvExp" => $invClvExp,
                  "invClvEst" => $invClvEst
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates ClavesDetalles
           */
          public static function update(
            $invClvId,
            $invPrdId,
            $invClvSerial,
            $invClvExp,
            $invClvEst
          ) {
              $sqlstr = "UPDATE `claves_detalle` set
              `invPrdId`=:invPrdId,
              `invClvSerial`=:invClvSerial,
              `invClvExp`=:invClvExp,
              `invClvEst`=:invClvEst
             where `invClvId` =:invClvId;";
              $sqlParams = [
                "invClvId" => $invClvId,
                "invPrdId" => $invPrdId,
                "invClvSerial" => $invClvSerial,
                "invClvExp" => $invClvExp,
                "invClvEst" => $invClvEst
              ];
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
              $sqlstr = "DELETE from `claves_detalle` where invClvId=:invClvId;";
              $sqlParams = array(
                  "invClvId" => $invClvId,
                  "invClvEst" => "INA"
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }

      }
?>