<?php

      namespace Dao\Mnt;

      use Dao\Table;
      /**
       * Modelo de Datos para la tabla de Categoria
       *
       * @category Data_Model
       * @package  Dao.Table
       * @author
       * @license  Comercial http://
       *
       * @link http://url.com
      */
      class Categorias extends Table
      {
          /*
          Tabla a generar:
          catid
catnom
catest

          */
          /**
           * Obtiene todos los registros de Categorias
           *
           * @return array
           */
          public static function getAll()
          {
              $sqlstr = "Select * from categorias;";
              return self::obtenerRegistros($sqlstr, array());
          }
      
          /**
           * Get Categorias By Id
           *
           * @param int $catid Codigo del Categorias
           *
           * @return array
           */
          public static function getById(int $catid)
          {
              $sqlstr = "SELECT * from `categorias` where catid=:catid;";
              $sqlParams = array("catid" => $catid);
              return self::obtenerUnRegistro($sqlstr, $sqlParams);
          }
      
          /**
           * Insert into Categorias
           */
          public static function insert(
            $catnom,
            $catest
          ) {
              $sqlstr = "INSERT INTO `categorias`
      (`catnom`,`catest`)
      VALUES
      (:catnom,:catest);
      ";
              $sqlParams = [
                  "catnom" => $catnom, "catest" => $catest
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates Categorias
           */
          public static function update(
            $catid,
            $catnom,
            $catest
          ) {
              $sqlstr = "UPDATE `categorias` set   `catnom`=:catnom, `catest`=:catest
              where `catid` =:catid;";
              $sqlParams = [
                "catid" => $catid,
                "catnom" => $catnom,
                "catest" => $catest
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
          /**
           * Undocumented function
           *
           * @param [type] $catid Codigo del Categorias
           *
           * @return void
           */
          public static function delete($catid)
          {
              $sqlstr = "DELETE from `categorias` where catid=:catid;";
              $sqlParams = array(
                  "catid" => $catid
              );
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
      
      }
      
      ?>