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
	            'total'=>10, 
                  ],
        
        /*
         Payment methods to be displayed for the user on the checkout screen: 
        4 - Web QR; 5 – Pan (Card) Payment 6 – Ertguli Points 
        7 – Internet Bank Login; 8 - Installment; 9 - Apple Pay.
        */
        'methods'=>[4,5,6,7,8,9], 
        
        
        /*
        List of installment products. mandatory if installment is selected as payment method. 
        Please note, sum of prices of installment products should be same as total amount.
        */
        'installmentProducts'=>[['name'=>'T-shirt','price'=>10,'quantity'=>1]],
        
        /*
        Callback url to redirect user after finishing payment
        */
        'returnurl'=>'http://localhost:8000/examples/',
        
        /*
        Merchant callbackURL - when payment status changes
        */
        'callbackUrl'=>'http://localhost:8000/examples/callbackUrl.php', 
        
        /*
        Specify if preauthorization is needed for the transaction. 
        if "true" is passed, amount will be blocked on the card and additional 
        request should be executed by merchant to complete payment. 
        To finalize authorization process, /v1/tpay/payments/:paymentId/completion endpoint should be used. 
        By default block is saved for 30 days, although some banks may have a different setting, 
        so this setting depends on the card issuing bank (Isuer Bank)
        */
        'preAuth'=>false,
        
        /*
        Default language for payment page
        The following values are allowed:
        KA, EN, RU
        */
        'language'=>'EN',
        
        /*
        Merchant-side payment identifier
        */
        'merchantPaymentId'=>'order#1'
       ];



$res = $TBCCheckout->RequestPayment($param);



if (DEBUG && !empty($TBCCheckout->error))
die($TBCCheckout->error);



if (!isset($res['links'][1]['uri']))
 die($res);


/***
Save payId in your system
*/

/*
Redirect payment page
*/
header('Location: '.$res['links'][1]['uri']);
die;

?>