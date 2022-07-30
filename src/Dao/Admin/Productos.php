<?php
      
      namespace Dao\Admin;
      
      use Dao\Table;
      
      /**
       * Modelo de Datos para la tabla de Producto
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author   
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class Productos extends Table
      {
          /*
          Tabla a generar:
          invPrdId
invPrdName
invPrdDsc
invPrdCat
invPrdEst
invPrdPrice
invPrdImg

          */
          /**
           * Obtiene todos los registros de Productos
           *
           * @return array
           */
          public static function getAll()
          {
              $sqlstr = "Select * from productos;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get Productos By Id
           *
           * @param int $invPrdId Codigo del Productos
           *
           * @return array
           */
          public static function getById(int $invPrdId)
          {
              $sqlstr = "SELECT * from `productos` where invPrdId=:invPrdId;";
              $sqlParams = array("invPrdId" => $invPrdId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into Productos
           */
          public static function insert(
            $invPrdName,
$invPrdDsc,
$invPrdCat,
$invPrdEst,
$invPrd,
$invPrdPrice,
$invPrdImg
          ) {
              $sqlstr = "INSERT INTO `productos`
      (`invPrdName`,
`invPrdDsc`,
`invPrdCat`,
`invPrdEst`,
`invPrd`,
`invPrdPrice`,
`invPrdImg`)
      VALUES
      (:invPrdName,
:invPrdDsc,
:invPrdCat,
:invPrdEst,
:invPrd,
:invPrdPrice,
:invPrdImg);
      ";
              $sqlParams = [
                  "invPrdName" => $invPrdName,
"invPrdDsc" => $invPrdDsc,
"invPrdCat" => $invPrdCat,
"invPrdEst" => $invPrdEst,
"invPrd" => $invPrd,
"invPrdPrice" => $invPrdPrice,
"invPrdImg" => $invPrdImg
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates Productos
           */
          public static function update(
            $invPrdId,
$invPrdName,
$invPrdDsc,
$invPrdCat,
$invPrdEst,
$invPrd,
$invPrdPrice,
$invPrdImg
          ) {
              $sqlstr = "UPDATE `productos` set 
      `invPrdName`=:invPrdName,
`invPrdDsc`=:invPrdDsc,
`invPrdCat`=:invPrdCat,
`invPrdEst`=:invPrdEst,
`invPrd`=:invPrd,
`invPrdPrice`=:invPrdPrice,
`invPrdImg`=:invPrdImg
      where `invPrdId` =:invPrdId;";
              $sqlParams = [
                "invPrdId" => $invPrdId,
"invPrdName" => $invPrdName,
"invPrdDsc" => $invPrdDsc,
"invPrdCat" => $invPrdCat,
"invPrdEst" => $invPrdEst,
"invPrd" => $invPrd,
"invPrdPrice" => $invPrdPrice,
"invPrdImg" => $invPrdImg
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
          /**
           * Undocumented function
           *
           * @param [type] $invPrdId Codigo del Productos
           *
           * @return void
           */
          public static function delete($invPrdId)
          {
              $sqlstr = "DELETE from `productos` where invPrdId=:invPrdId;";
              $sqlParams = array(
                  "invPrdId" => $invPrdId
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
      ?>