<?php

namespace Utilities\HtmlOrder;

class EmailGenerator {
    public static function createOrderEmail($OrderData, $ProductList)
    {
            $htmlMail = '<div style="font-family:`Sans-Serif`; text-align: center; padding-top: 1rem; flex-direction: column; border-radius: 10px; background-color:#f4f4f4; padding-bottom: 10px; width:65%">
            <img style="text-align: center;" src="https://cemesablobstorage.blob.core.windows.net/blobsimg/logo_transparent.png" alt="" width="350px">
            <h2 style="font-size: 1.4rem; color:black; text-align: center; font-family: `Segoe UI`;">Detalles de la Compra</h2>';

            foreach ($OrderData as $Order) {
                $htmlMail .= '<div style="margin-left: 2.7vw; text-align: left;">
                        <h3 style="color:black; font-size:1.1rem; font-family: `Segoe UI`;" >Referencia: '.$Order["orderCode"].'</h3>
                        <h3 style="color:black; font-size:1.1rem; font-family: `Segoe UI`;" >Fecha: '.$Order["created_at"].'</h3>
                        <h3 style="color:black; font-size:1.1rem; font-family: `Segoe UI`;" >Método de Pago: '.$Order["providerName"].'</h3>
                        <h3 style="color:black; font-size:1.1rem; font-family: `Segoe UI`;" >Total: Lps. '.$Order["total"].'</h3>
                        <h3 style="color:black; font-size:1.1rem; font-family: `Segoe UI`;" >Total USD: $'.$Order["totalUSD"].'</h3>
                    </div>
                    <div style="color:black; font-size: 1.2rem; margin-bottom:1rem; text-align: center; font-family: `Segoe UI`;"><strong>Listado de Productos</strong></div>';                       
            }

            foreach ($ProductList as $Product) {
            
            $htmlMail .= '<div style="display: flex; margin-left: 2vw; margin-right: 2vw; border-radius: 10px; margin-bottom: 1rem; background-color: white; align-items: center; padding-top: 0.5rem; padding-bottom: 1rem;">
                    <div style="text-align:left; padding:1rem 2rem 1rem 2rem; width: 80%;">
                        <div style="display: flex; align-items:center;">
                            <img src="https://www.freeiconspng.com/uploads/software-icon-30.png" alt="" width="140px" height="140px" style="border-radius: 10px;">
                            <div style="margin-left: 4rem;">
                                <h2 style="color:black; font-family: `Segoe UI`;"><strong>'. $Product["invPrdName"] .'</strong></h2>
                                <span style="color:black; font-size:1rem; font-family: `Segoe UI`;">'. $Product["catnom"] .'</span>
                                <p style="color:black; font-size:1.2rem; font-family: `Segoe UI`;">
                                    <strong>Product Key: '.$Product["invPrdName"].'</strong> 
                                </p>
                            </div>
                        </div>
                    </div>
                    <div style="text-align:center; padding: 0 2.5em; width: 20%;">
                        <div style="color:black; margin-top:50%; font-size: 1.4rem; font-family: `Segoe UI`;"><strong>Lps. '.$Product["invPrdPriceISV"].'</strong></div>
                    </div>
                </div>';           
            }

            $htmlMail .= '</div>';

           

        return $htmlMail ;
    }
}
?>
