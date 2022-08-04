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
              pr.invPrdEst,
              pr.invPrdImg, COUNT(cd.invPrdId) as stock FROM softwarelat_db.productos pr
				      inner join softwarelat_db.categorias cat
                ON pr.invPrdCat = cat.catid
                left join (SELECT * FROM softwarelat_db.claves_detalle WHERE invClvEst = 'ACT'  AND invClvExp > now()) as cd
                ON pr.invPrdId = cd.invPrdId
                GROUP BY pr.invPrdId;";
              return self::obtenerRegistros($sqlstr, array());
          }

          /**
           * Obtiene todos los registros de Productos paginados
           *
           * @return array
           */
          public static function getAllByPagination(int $lim, int $offs, $catid, $search)
          {
              if (intval($catid) == -1) {
                  $sqlstr = "SELECT pr.invPrdId,
                  pr.invPrdName,
                  pr.invPrdDsc,
                  cat.catnom as invPrdCat,
                  pr.invPrdEst,
                  pr.invPrdPriceISV,
                  pr.invPrdPrice,
                  pr.invPrdEst,
                  pr.invPrdImg, COUNT(cd.invPrdId) as stock FROM softwarelat_db.productos pr
                  inner join softwarelat_db.categorias cat
                    ON pr.invPrdCat = cat.catid
                    left join (SELECT * FROM softwarelat_db.claves_detalle WHERE invClvEst = 'ACT'  AND invClvExp > now()) as cd
                    ON pr.invPrdId = cd.invPrdId WHERE pr.invPrdName LIKE ".$search." AND pr.invPrdEst = 'ACT'
                    GROUP BY pr.invPrdId LIMIT :lim OFFSET :offs;";
                  $sqlParams = array(
                    "lim" => $lim,
                    "offs" => $offs);
              }else{
                    $sqlstr = "SELECT pr.invPrdId,
                    pr.invPrdName,
                    pr.invPrdDsc,
                    cat.catnom as invPrdCat,
                    pr.invPrdEst,
                    pr.invPrdPriceISV,
                    pr.invPrdPrice,
                    pr.invPrdEst,
                    pr.invPrdImg, COUNT(cd.invPrdId) as stock FROM softwarelat_db.productos pr
				            inner join softwarelat_db.categorias cat
                    ON pr.invPrdCat = cat.catid
                    left join (SELECT * FROM softwarelat_db.claves_detalle WHERE invClvEst = 'ACT'  AND invClvExp > now()) as cd
                    ON pr.invPrdId = cd.invPrdId  WHERE cat.catid =:catid AND pr.invPrdEst = 'ACT'
                    GROUP BY pr.invPrdId LIMIT :lim OFFSET :offs;";
                    $sqlParams = array(
                    "lim" => $lim,
                    "offs" => $offs,
                    "catid" => $catid);
              }
              return self::obtenerRegistros($sqlstr, $sqlParams);
          }

          /**
           * Obtiene todos los registros de Productos para el filtro de productos destacados
           *
           * @return array
           */
          public static function getAllFeatureProducts()
          {
              $sqlstr = "SELECT pr.invPrdId, pr.invPrdName, ca.catnom, pr.invPrdPriceISV, pr.invPrdImg, count(oi.invPrdId) as CantidadVendida 
              from order_item oi right join productos pr 
              on oi.invPrdId = pr.invPrdId 
              inner join categorias ca on ca.catid = pr.invPrdCat
              group by pr.invPrdId order by CantidadVendida desc LIMIT 10;";
              return self::obtenerRegistros($sqlstr, array());
          }

          /**
           * Obtiene la cuenta de ventas por mes para el dashboard
           *
           * @return array
           */
          public static function getSalesCountByMonth()
          {
              $sqlstr = "SELECT me.idmes, count(month(od.created_at)) as cantVentas FROM softwarelat_db.meses ME
              LEFT JOIN order_details od ON me.idmes = month(od.created_at) 
              GROUP BY (me.idmes) ORDER by me.idmes ASC;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get Productos By Id for detail
           *
           * @param int $invPrdId Codigo del Productos
           *
           * @return array
           */
          public static function getByIdForDetail(int $invPrdId)
          {
              $sqlstr = "SELECT pr.invPrdId, pr.invPrdName, pr.invPrdDsc, ca.catnom, pr.invPrdPriceISV, pr.invPrdImg 
              from productos pr 
              inner join categorias ca on ca.catid = pr.invPrdCat
              WHERE pr.invPrdId=:invPrdId;";
              $sqlParams = array("invPrdId" => $invPrdId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }

          /**
           * Get Stock By Id Of Product for detail
           *
           * @param int $invPrdId Codigo del Productos
           *
           * @return array
           */
          public static function getStockByIdForDetail(int $invPrdId)
          {
              $sqlstr = "SELECT count(*) - (SELECT ifnull(sum(quantity), 0) from cart_item 
              where invPrdId =:invPrdId) as disponibles_venta 
              from claves_detalle 
              where invPrdId =:invPrdId and invClvEst = 'ACT' and invClvExp >= now();";
              $sqlParams = array("invPrdId" => $invPrdId);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }

          /**
           * Get Count of Product for Pagination
           *
           *
           * @return array
           */
          public static function getProductsCount($catid, $search)
          {
            if (intval($catid) == -1 ) {
              $sqlstr = "SELECT count(*) as countProductos
              FROM softwarelat_db.productos pr 
              where pr.invPrdName LIKE ".$search." AND pr.invPrdEst = 'ACT';";
              $sqlParams = array();
            }
            else{
              $sqlstr = "SELECT count(*) as countProductos
                FROM softwarelat_db.productos pr 
                where pr.invPrdEst = 'ACT' AND pr.invPrdCat=:catid;";
              $sqlParams = array("catid" => $catid);
            }
              
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }

          /**
           * Get Productos By Id for Detail
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
            $invPrdPriceISV,
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
                "invPrdEst" => "ACT",
                "invPrdPriceISV" => floatval($invPrdPriceISV),
                "invPrdPrice" => floatval($invPrdPriceISV) - (floatval($invPrdPriceISV)*0.15),
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
            $invPrdPriceISV,
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
                "invPrdPriceISV" => doubleval($invPrdPriceISV),
                "invPrdPrice" => doubleval($invPrdPriceISV) - (doubleval($invPrdPriceISV)*0.15),
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
                  "invPrdEst" => "INA"
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
?>