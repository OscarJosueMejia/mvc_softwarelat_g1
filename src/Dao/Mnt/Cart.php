<?php

namespace Dao\Mnt;

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
     * Get Cart Items By Shopping Session Code
     *
     * @param int $shopSessionId Código de la Sesión de Compra
     *
     * @return array
     */
    public static function getCartItems($shopSessionId){

        $sqlstr = "SELECT a.cartItemId, a.shopSessionId, a.invPrdId, b.invPrdName, b.invPrdPrice, 
        b.invPrdDsc, b.invPrdCat, b.invPrdEst, b.invPrdImg, a.quantity, (b.invPrdPrice * a.quantity) as amount 
        from cart_item a inner join productos b on a.invPrdId = b.invPrdId 
        where shopSessionId=:shopSessionId;";

        $sqlParams = array("shopSessionId" => $shopSessionId);

        return self::obtenerRegistros($sqlstr, $sqlParams);
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
            "created_at" => date('m/d/y h:i:s',time()),
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Update Shopping Session
     *
     * @param [type] $usercod Current User Code
     * @return void
     */
    public static function updateShopSession($usercod) {
        $sqlstr = "UPDATE `shopping_session` SET 
        `modified_at`=:modified_at 
        where `usercod`=:usercod;";
        
        $sqlParams = [
            "usercod" => $usercod ,
            "modified_at" => date('m/d/y h:i:s',time()),
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
            "shopSessionId" => $shopSessionId ,
            "invPrdId" => $invPrdId ,
            "quantity" => $quantity ,
            "created_at" => date('m/d/y h:i:s',time()),
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
        where `cartItemId`=:cartItemId and `shopSessionId`=:$shopSessionId;";
        
        $sqlParams = [
            "cartItemId" => $cartItemId ,
            "shopSessionId" => $shopSessionId ,
            "quantity" => $quantity ,
            "modified_at" => date('m/d/y h:i:s',time()),
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
     * Returns the amount of product that can be purchased 
     *
     * @param [type] $invPrdId Product to find
     * @return void
     */
    public static function getProductCountAvailable($invPrdId){
        $sqlstr = "SELECT count(*) - (SELECT sum(quantity) from cart_item where invPrdId =:invPrdId) as disponibles_venta from claves_detalle where invPrdId =:invPrdId and invClvEst = 'ACT';";
        $sqlParams = array("invPrdId" => $invPrdId);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Check if Product already exists on shopping session.
     *
     * @param [type] $invPrdId Product to find
     * @param [type] $usercod Current User
     * @return void
     */
    public static function checkIfProductIsOnCart($invPrdId, $usercod){
        $sqlstr = "SELECT count(a.cartItemId) from cart_item a inner join shopping_session b 
        on a.shopSessionId = b.shopSessionId where invPrdId =:invPrdId and usercod =:usercod;";
                   
        $sqlParams = [
            "invPrdId" => $invPrdId ,
            "usercod" => $usercod ,
        ];

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }
}
