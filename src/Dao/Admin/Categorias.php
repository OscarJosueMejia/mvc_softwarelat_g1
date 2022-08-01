<?php

      namespace Dao\Admin;

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
           * Obtiene todos los registros de Categorias Activos
           *
           * @return array
           */
          public static function getAllActives()
          {
              $sqlstr = "Select * from categorias where catest='ACT';";
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
            $catdesc,
            $catest
          ) {
              $sqlstr = "INSERT INTO `categorias`
              (`catnom`, `catdesc`)
              VALUES
              (:catnom, :catdesc);
              ";
              $sqlParams = [
                  "catnom" => $catnom,
                  "catdesc" => $catdesc
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }
          /**
           * Updates Categorias
           */
          public static function update(
            $catid,
            $catnom,
            $catdesc,
            $catest
          ) {
              $sqlstr = "UPDATE `categorias` set   `catnom`=:catnom, `catdesc`=:catdesc, `catest`=:catest
              where `catid` =:catid;";
              $sqlParams = [
                "catid" => $catid,
                "catnom" => $catnom,
                "catdesc" => $catdesc,
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
              $sqlstr = "UPDATE `categorias` set  `catest`=:catest
              where `catid` =:catid;";
              $sqlParams = [
                "catid" => $catid,
                "catest" => "INA"
              ];
              return self::executeNonQuery($sqlstr, $sqlParams);
          }

      }

?>