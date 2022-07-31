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
          invPrdPriceISV
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
              $sqlstr = "SELECT pr.invPrdId,
              pr.invPrdName,
              pr.invPrdDsc,
              cat.catnom as invPrdCat,
              pr.invPrdEst,
              pr.invPrdPriceISV,
              pr.invPrdPrice,
              pr.invPrdImg, COUNT(cd.invPrdId) as stock FROM softwarelat_db.productos pr
				      inner join softwarelat_db.categorias cat
                ON pr.invPrdCat = cat.catid
                left join (SELECT * FROM softwarelat_db.claves_detalle WHERE invClvEst = 'ACT'  AND invClvExp > now()) as cd
                ON pr.invPrdId = cd.invPrdId
                GROUP BY pr.invPrdId;";
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
            $invPrdPrice,
            $invPrdImg
          ) {
              $sqlstr = "INSERT INTO `productos`
            (`invPrdName`,
            `invPrdDsc`,
            `invPrdCat`,
            `invPrdEst`,
            `invPrdPriceISV`,
            `invPrdPrice`,
            `invPrdImg`)
            VALUES
            (:invPrdName,
            :invPrdDsc,
            :invPrdCat,
            :invPrdEst,
            :invPrdPriceISV,
            :invPrdPrice,
            :invPrdImg);
            ";
              $sqlParams = [
                "invPrdName" => $invPrdName,
                "invPrdDsc" => $invPrdDsc,
                "invPrdCat" => $invPrdCat,
                "invPrdEst" => $invPrdEst,
                "invPrdPriceISV" => floatval($invPrdPrice),
                "invPrdPrice" => floatval($invPrdPrice) - (floatval($invPrdPrice)*0.15),
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
            $invPrdPrice,
            $invPrdImg
          ) {
              $sqlstr = "UPDATE `productos` set 
            `invPrdName`=:invPrdName,
            `invPrdDsc`=:invPrdDsc,
            `invPrdCat`=:invPrdCat,
            `invPrdEst`=:invPrdEst,
            `invPrdPriceISV`=:invPrdPriceISV,
            `invPrdPrice`=:invPrdPrice,
            `invPrdImg`=:invPrdImg
            where `invPrdId` =:invPrdId;";
              $sqlParams = [
                "invPrdId" => $invPrdId,
                "invPrdName" => $invPrdName,
                "invPrdDsc" => $invPrdDsc,
                "invPrdCat" => $invPrdCat,
                "invPrdEst" => $invPrdEst,
                "invPrdPriceISV" => doubleval($invPrdPrice),
                "invPrdPrice" => doubleval($invPrdPrice) - (doubleval($invPrdPrice)*0.15),
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
              $sqlstr = "UPDATE `productos` SET `invPrdEst`=:invPrdEst where `invPrdId`=:invPrdId;";
              $sqlParams = array(
                  "invPrdId" => $invPrdId,
                  "invPrdEst" => $invPrdEst
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
?>