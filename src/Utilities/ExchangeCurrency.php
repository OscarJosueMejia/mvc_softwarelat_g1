<?php

namespace Utilities;

use Throwable;

class ExchangeCurrency {

    public static function getUSDCurrentValue()
    {
        // $api_key = \Utilities\Context::getContextByKey("EXCHANGE_V6_KEY");

        // $req_url = "https://v6.exchangerate-api.com/v6/".$api_key."/latest/HNL";
        // $response_json = file_get_contents($req_url);
        // // Continuing if we got a result
        // if(false !== $response_json) {

        //     // Try/catch for json_decode operation
        //     try {

        //         // Decoding
        //         $response = json_decode($response_json);

        //         // Check for success
        //         if('success' === $response->result) {
        //             return $response->conversion_rates->USD;
        //         }
                
        //     }
        //     catch(Throwable $e) {
        //         return false;
        //     }

        // }
        return 0.04081;
    }
}