<?php

namespace Dao\Orders;

use Dao\Table;

class Order extends Table
{
    /**
     * Get Order List by Current User
     *
     * @param int $usercod Código del Usuario Actual
     *
     * @return array
     */
    public static function getOrders($usercod){
        $sqlstr = "SELECT * FROM order_details a inner join payment_details b on a.orderId = b.orderId where a.usercod = :usercod;";
        $sqlParams = array("usercod" => $usercod);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Get Order List [ADMIN MODE]
     *
     * @return array
     */
    public static function getOrdersAdm(){
        $sqlstr = "SELECT * FROM order_details a inner join payment_details b on a.orderId = b.orderId;";

        return self::obtenerRegistros($sqlstr, []);
    }

    /**
     * Get general Order Count
     *
     * @param int $usercod Código del Usuario Actual
     *
     * @return array
     */
    public static function getOrderUtils(){
        $base_code = "SFTLT-";
        $digits_count = 6;
        $finalData = array();

        $sqlstr = "SELECT count(*) as OrderFullCount from order_details;";

        $lastValue = self::obtenerUnRegistro($sqlstr, [])["OrderFullCount"] + 1;
        $lastValueLength = strlen((string)$lastValue);

        for ($i=0; $i < $digits_count - $lastValueLength ; $i++) { 
            $base_code .= "0";
        }
        $base_code .= (string)$lastValue;
        
        $finalData["OrderFullCount"] = $lastValue;
        $finalData["NextOrderCode"] = $base_code;
        
        return $finalData;
    }

    /**
     * Get Order Details by Order Code
     *
     * @param int $orderId Código de la Orden
     *
     * @return array
     */    
    public static function getOrderById($orderId){
        $sqlstr = "SELECT * FROM order_details a inner join payment_details b on a.orderId = b.orderId where a.orderId = :orderId;";
        $sqlParams = array("orderId" => $orderId);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }
    
    /**
     * Get Products from order 
     *
     * @param int $orderId Código de la Orden
     *
     * @return array
     */
    public static function getOrderItems($orderId){

        $sqlstr = "SELECT a.orderItemId, a.orderId, a.invPrdId, b.invPrdName, 
        b.invPrdDsc, b.invPrdPrice, b.invPrdPriceISV, c.invClvId, c.invClvSerial, c.invClvExp, d.catnom 
        FROM order_item a inner join productos b on a.invPrdId = b.invPrdId 
        inner join claves_detalle c on a.invClvId = c.invClvId 
        inner join categorias d on b.invPrdCat = d.catid
        where a.orderId =:orderId";

        $sqlParams = array("orderId" => $orderId);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Create New Order
     *
     * @param [int] $usercod Current User Code
     * @param [int] $total Total amount to pay
     * @return void
     */
    public static function createOrder($usercod, $orderCode, $total, $totalUSD) {
        $sqlstr = "INSERT INTO `order_details`
        (`usercod`, `orderCode`, `total`, `totalUSD` , `created_at`) VALUES (:usercod, :orderCode , :total, :totalUSD, :created_at);";
        
        $sqlParams = [
            "usercod" => $usercod,
            "orderCode" => $orderCode,
            "total" => $total,
            "totalUSD" => $totalUSD,
            "created_at" => date('y/m/d h:i:s',time()),
        ];
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Get last order registered on DB
     *
     * @param [int] $usercod Current User Code
     * @return void
     */
    public static function getLastOrder($usercod) {
        $sqlstr = "SELECT max(orderId) as LastOrder from order_details where usercod =:usercod;";
        
        $sqlParams = [
            "usercod" => $usercod ,
        ];

        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert Cart Item to Order 
     *
     * @param [type] $orderId Last order inserted
     * @param [type] $invPrdId Product ID
     * @param [type] $invClvId Product KEY ID
     * @return void
     */
    public static function insertOrderItem($orderId, $invPrdId, $invClvId) {
        
        $sqlstr = "INSERT INTO `order_item`
        (`orderId`, `invPrdId`, `invClvId`, `created_at`) 
        VALUES (:orderId, :invPrdId, :invClvId, :created_at);";
        
        $sqlParams = [
            "orderId" => $orderId ,
            "invPrdId" => $invPrdId ,
            "invClvId" => $invClvId ,
            "created_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Extract products keys
     *
     * @param [type] $invPrdId Product ID
     * @param [type] $quantity Product Quantity of Keys
     * @return void
     */
    public static function getProductKeys($invPrdId, $quantity) {
        $sqlstr = "SELECT invClvId from claves_detalle where invPrdId =:invPrdId and invClvEst = 'ACT' and invClvExp >= now() order by invClvExp asc limit :quantity;";
        
        $sqlParams = [
            "invPrdId" => $invPrdId,
            "quantity" => $quantity,
        ];

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Unset products keys
     *
     * @param [type] $invPrdId Product ID
     * @param [type] $quantity Product Quantity of Keys
     * @return void
     */
    public static function disableKey($invClvId) {
        
        $sqlstr = "UPDATE `claves_detalle` SET 
        `invClvEst`=:invClvEst 
        where `invClvId`=:invClvId;";
        
        $sqlParams = [
            "invClvEst" => "VEN",
            "invClvId" => $invClvId,
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Insert Payment Data
     *
     * @param [type] $orderId Order Code
     * @param [type] $amount Order Total
     * @param [type] $providerName Service Provider
     * @param [type] $orderJSON Order Details from PayPal
     * @param [type] $payStatus Status
     * @return void
     */
    public static function insertPaymentData($orderId, $amount, $providerName, $orderJSON, $payStatus) {
        
        $sqlstr = "INSERT INTO `payment_details`
        (`orderId`, `amount`, `providerName`, `orderJSON`, `payStatus` ,`created_at`) 
        VALUES (:orderId, :amount, :providerName, :orderJSON, :payStatus, :created_at);";
        
        $sqlParams = [
            "orderId" => $orderId,
            "amount" => $amount,
            "providerName" => $providerName,
            "orderJSON" => $orderJSON,
            "payStatus" => $payStatus,
            "created_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Insert PayPal Order Token Temporaly
     *
     * @param [type] $usercod Current User Id
     * @param [type] $orderToken Order Token
     * @return void
     */
    public static function saveOrderToken($usercod, $orderToken) {
        
        $sqlstr = "INSERT INTO `paypal_tokens`
        (`usercod`, `orderToken` ,`created_at`) 
        VALUES (:usercod, :orderToken, :created_at);";
        
        $sqlParams = [
            "usercod" => $usercod,
            "orderToken" => $orderToken,
            "created_at" => date('y/m/d h:i:s',time()),
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Get PayPal Order Token Temporaly
     *
     * @param [type] $usercod Current User Id
     * @param [type] $orderToken Order Token
     * @return void
     */
    public static function getOrderToken($usercod) {
        
        $sqlstr = " SELECT count(orderToken) as TokensCount, orderToken FROM paypal_tokens where usercod =:usercod;";

        $sqlParams = array("usercod" => $usercod);

        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }


    /**
     * Delete PayPal Order Token
     *
     * @param [type] $usercod Current User Id
     * @param [type] $orderToken Order Token
     * @return void
     */
    public static function deleteOrderToken($usercod) {
        $sqlstr = "DELETE FROM `paypal_tokens` where `usercod`=:usercod;";

        $sqlParams = [
            "usercod" => $usercod,
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }
}
