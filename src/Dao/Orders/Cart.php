<?php

namespace Dao\Orders;

use Dao\Table;

class Cart extends Table
{

    /**
     * Get Shopping Session By Current User Code
     *
     * @param int $usercod Código del Usuario Actual
     *
     * @return array
     */
    public static function getShoppingSession($usercod){
        $sqlstr = "SELECT * from shopping_session where usercod=:usercod;";
        $sqlParams = array("usercod" => $usercod);

        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }
    
    /**
     * Get Shopping Session ID By Current User Code
     *
     * @param int $usercod Código del Usuario Actual
     *
     * @return array
     */
    public static function getShoppingSessionId($usercod){
        $sqlstr = "SELECT shopSessionId from shopping_session where usercod=:usercod;";
        $sqlParams = array("usercod" => $usercod);

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["shopSessionId"];
    }
    
    /**
     * Get Check if Current User Code has shopping Session enabled
     *
     * @param int $usercod Código del Usuario Actual
     *
     * @return array
     */
    public static function checkExistentShopSession($usercod){
        $sqlstr = "SELECT count(*) as SessionCount from shopping_session where usercod=:usercod;";
        $sqlParams = array("usercod" => $usercod);

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["SessionCount"] > 0;
    }
    
    /**
     * Get Cart Items By Shopping Session Code
     *
     * @param int $shopSessionId Código de la Sesión de Compra
     *
     * @return array
     */
    public static function getCartItems($shopSessionId){

        $sqlstr = "SELECT a.cartItemId, a.shopSessionId, a.invPrdId, b.invPrdName, b.invPrdPrice, b.invPrdPriceISV,
        b.invPrdDsc, b.invPrdCat, b.invPrdEst, b.invPrdImg, a.quantity, (b.invPrdPrice * a.quantity) as amountNoISV, (b.invPrdPriceISV * a.quantity) as amount, c.catnom  
        from cart_item a inner join productos b on a.invPrdId = b.invPrdId inner join categorias c on b.invPrdCat = c.catid
        where shopSessionId=:shopSessionId;";

        $sqlParams = array("shopSessionId" => $shopSessionId);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Get Cart Items Count By Shopping Session Code
     *
     * @param int $shopSessionId Código de la Sesión de Compra
     *
     * @return int
     */
    public static function getCartCount($shopSessionId){

        $sqlstr = "SELECT count(*) as CountItems from cart_item where shopSessionId=:shopSessionId;";
        $sqlParams = array("shopSessionId" => $shopSessionId);

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["CountItems"];
    }

    /**
     * Get Cart Items Count By Shopping Session Code
     *
     * @param int $shopSessionId Código de la Sesión de Compra
     *
     * @return int
     */
    public static function getCartAllItems($shopSessionId){

        $sqlstr = "SELECT sum(quantity) as CountItems from cart_item  where shopSessionId =:shopSessionId;";
        $sqlParams = array("shopSessionId" => $shopSessionId);

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["CountItems"];
    }

    

    /**
     * Create Shopping Session
     *
     * @param [type] $usercod Current User Code
     * @return void
     */
    public static function createShopSession($usercod) {
        $sqlstr = "INSERT INTO `shopping_session`
        (`usercod`, `created_at`) VALUES (:usercod, :created_at);";
        
        $sqlParams = [
            "usercod" => $usercod ,
            "created_at" => date('y/m/d h:i:s',time()),
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Update Shopping Session
     *
     * @param [type] $usercod Current User Code
     * @return void
     */
    public static function updateShopSession($usercod, $total) {
        $sqlstr = "UPDATE `shopping_session` SET 
        `total`=:total, `modified_at`=:modified_at 
        where `usercod`=:usercod;";
        
        $sqlParams = [
            "usercod" => $usercod ,
            "total" => $total,
            "modified_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Add 2 days more to Shopping Session
     *
     * @param [type] $usercod Current User Code
     * @return void
     */
    public static function extendShopSession($usercod) {
        $sqlstr = "UPDATE `shopping_session` SET 
        `modified_at`= DATE_ADD(`modified_at`, INTERVAL 2 DAY) 
        where `usercod`=:usercod;";
        
        $sqlParams = [
            "usercod" => $usercod ,
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Insert Cart Item to Shop Session
     *
     * @param [type] $shopSessionId Current User Code
     * @param [type] $invPrdId Current User Code
     * @param [type] $quantity Current User Code
     * @return void
     */
    public static function insertCartItem($shopSessionId, $invPrdId, $quantity) {
        
        $sqlstr = "INSERT INTO `cart_item`
        (`shopSessionId`, `invPrdId`, `quantity`, `created_at`) 
        VALUES (:shopSessionId, :invPrdId, :quantity, :created_at);";
        
        $sqlParams = [
            "shopSessionId" => $shopSessionId,
            "invPrdId" => $invPrdId,
            "quantity" => $quantity,
            "created_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Update Cart Item in Shop Session
     *
     * @param [type] $shopSessionId Current User Code
     * @param [type] $invPrdId Current User Code
     * @param [type] $quantity Current User Code
     * @return void
     */
    public static function updateCartItem($shopSessionId, $cartItemId, $quantity) {
        $sqlstr = "UPDATE `cart_item` SET 
        `quantity`=:quantity, `modified_at`=:modified_at 
        where `cartItemId`=:cartItemId and `shopSessionId`=:shopSessionId;";
        
        $sqlParams = [
            "cartItemId" => $cartItemId ,
            "shopSessionId" => $shopSessionId ,
            "quantity" => $quantity ,
            "modified_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Delete Cart Item in Shop Session
     *
     * @param [type] $cartItemId Cart Item to delete
     * @return void
     */
    public static function deleteCartItem($cartItemId)
    {
        $sqlstr = "DELETE from `cart_item` where `cartItemId` =:cartItemId;";
        $sqlParams = array(
            "cartItemId" => $cartItemId
        );

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Delete All Cart Items in Shop Session
     *
     * @param [type] $cartItemId Cart Item to delete
     * @return void
     */
    public static function deleteAllCartItems($shopSessionId)
    {
        try {
            $sqlstr = "DELETE from `cart_item` where `shopSessionId` =:shopSessionId;";
            $sqlParams = array(
                "shopSessionId" => $shopSessionId
            );
            return self::executeNonQuery($sqlstr, $sqlParams);
        } catch (\Throwable $th) {
            error_log($th);
        }
    }

    /**
     * Delete All Cart Items in Shop Session
     *
     * @param [type] $cartItemId Cart Item to delete
     * @return void
     */
    public static function deleteShoppingSession($shopSessionId)
    {
        try {
            $sqlstr = "DELETE from `shopping_session` where `shopSessionId` =:shopSessionId;";
            $sqlParams = array(
                "shopSessionId" => $shopSessionId
            );
            return self::executeNonQuery($sqlstr, $sqlParams);
        } catch (\Throwable $th) {
            error_log($th);
        }
    }


    /**
     * Returns the amount of product that can be purchased 
     *
     * @param [type] $invPrdId Product to find
     * @return void
     */
    public static function getProductCountAvailable($invPrdId){
        $sqlstr = "SELECT count(*) - (SELECT sum(quantity) from cart_item where invPrdId =:invPrdId) as disponibles_venta from claves_detalle where invPrdId =:invPrdId and invClvEst = 'ACT' and invClvExp >= now();";
        $sqlParams = array("invPrdId" => $invPrdId);

        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Returns the amount of product that can be purchased 
     *
     * @param [type] $invPrdId Product to find
     * @return void
     */
    public static function secondCheckProducts($invPrdId, $shopSessionId){
        
        $sqlstr = "SELECT count(*) - (SELECT ifnull(sum(quantity),0) from cart_item where invPrdId =:invPrdId and shopSessionId <> :shopSessionId) as disponibles_venta from claves_detalle where invPrdId =:invPrdId and invClvEst = 'ACT' and datediff(invClvExp, now()) > 1;";
        $sqlParams = array(
            "invPrdId" => $invPrdId,
            "shopSessionId" => $shopSessionId
        );

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["disponibles_venta"];
    }

     /**
     * Sum cart amounts by shopping session.
     *
     * @param [type] $shopSessionId Shopping Session Id
     * @return void
     */
    public static function getCartTotal($shopSessionId){
        $sqlstr = "SELECT sum(b.invPrdPriceISV * a.quantity) as session_total, sum(b.invPrdPrice * a.quantity) as session_subtotal from cart_item a inner join productos b on a.invPrdId = b.invPrdId where shopSessionId =:shopSessionId;";
        $sqlParams = array("shopSessionId" => $shopSessionId);

        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Calls DB Procedure to delete shopping session greater than 3 days.
     *
     * @return void
     */
    public static function deleteSessionsByTime(){
        $sqlstr = "call DeleteShopSessionByTime();";
        return self::executeNonQuery($sqlstr, []);
    }

    /**
     * Check if Product already exists on shopping session.
     *
     * @param [type] $invPrdId Product to find
     * @param [type] $usercod Current User
     * @return void
     */
    public static function checkIfProductIsOnCart($invPrdId, $usercod){
        $sqlstr = "SELECT count(a.cartItemId) as CountExistent from cart_item a inner join shopping_session b 
        on a.shopSessionId = b.shopSessionId where invPrdId =:invPrdId and usercod =:usercod limit 1;";
                   
        $sqlParams = [
            "invPrdId" => $invPrdId ,
            "usercod" => $usercod ,
        ];

        return self::obtenerUnRegistro($sqlstr, $sqlParams)["CountExistent"] >= 1;
    }
    
}
