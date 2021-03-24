<?php
/*
* This file is part of the TBC-Checkout project.
*
* Detailed instructions can be found in README.md or online
* @link https://github.com/Geopaysoft/TBC-Checkout
*
* @author geopaysoft.com  <info@geopaysoft.com>
* @license   https://opensource.org/licenses/MIT
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/


namespace Geopaysoft\TBCCheckout;

require dirname(__FILE__) . '/config.php';
require dirname(__FILE__) . '/../src/TBCCheckout.php';

$TBCCheckout = new TBCCheckout(CLIEND_ID,CLIENT_SECRET,APIKEY,DEBUG);

if (DEBUG && !empty($TBCCheckout->error))
echo $TBCCheckout->error;


$param= [
        'amount'=>[
	            /*
	             Transaction currency (3 digit ISO code). Note 1) 
	             payments in given currency should be enabled for the merchant by bank. 2) 
	             only "GEL" is available for payment methods 6 – Ertguli Points; 8 - Installment
	             The following values are allowed: GEL, USD, EUR
	            */
	            'currency'=>'GEL',
	            
	            /*
	             Total amount of payment
	            */
	            'total'=>0,
                  ],
        /*
          5 – Pan (Card) Payment
        */          
        'methods'=>[5],
        
        /*
        Callback url to redirect user after finishing payment
        */
        'returnurl'=>'http://localhost/examples/',
    
        /*
        Default language for payment page
        The following values are allowed:
        KA, EN, RU
        */
        'language'=>'EN',
        
        /*
        Merchant-side payment identifier
        */
        'merchantPaymentId'=>'order#1',
        
        /*
        Specify if saving card funcion is needed. This function should be enabled for the merchant by bank. 
        If true is passed, recId parameter should be returned in response, through this parameter merchant 
        can execute payment by saved card - POST /payments/execution. Zero amount is allowed for this function. 
        If card saving funtion is requested with preauthorization parameter=true, saved card execution 
        method will be activated after preauthorization completion. WebQR, ApplePay and installments 
        pay methods are not allowed for saving card request
        */
        'saveCard'=>true,
        
        /*
        In case of saving card this parameter should be passed in following format "MMYY". 
        Real expiry date must be verified by getting payment status with GET /payments/{payment-id}
        */
        'cardExpiryDate'=>'0524'
       ];


$res = $TBCCheckout->RequestPayment($param);


if (DEBUG && !empty($TBCCheckout->error))
die($TBCCheckout->error);


if (!isset($res['links'][1]['uri']))
 die($res);


/***
Save payId and recId  to Database
*/

/*
Redirect payment page
*/
header('Location: '.$res['links'][1]['uri']);
exit;



?>