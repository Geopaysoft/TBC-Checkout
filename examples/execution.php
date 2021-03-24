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


$param = [
        'recId'=>'E95011edFFFc*****1C936493bD154B7',
        'merchanTBCCheckoutmentId'=>'123456',
        'money'=>[
	            'currency'=>'GEL',
	            'amount'=>10,
                  ],
        'preAuth'=>false          
       ];



$res = $TBCCheckout->ExecutionPayment($param);


/*
Result example
 

Array
(
[payId] => 7md1c87*****118316
[status] => Succeeded
[currency] => GEL
[amount] => 0.02
[confirmedAmount] => 0.02
[returnedAmount] => 0
[links] =>
[transactionId] => CaWyrkBlaeO8wj*****Xkufn2Xs=
[paymentMethod] => 11
[preAuth] =>
[recurringCard] => Array
(
[recId] => E95011edFFFc4D4*****36493bD154B7
[cardMask] => 5***********9535
[expiryDate] => 0524
)
                                                                            
[httpStatusCode] => 200
[developerMessage] =>
[userMessage] =>
)
*/

if (DEBUG)
print_r($res);


if (isset($res['status']))
echo 'Status: ' . $res['status'] . PHP_EOL;
   

if (DEBUG && !empty($TBCCheckout->error))
echo $TBCCheckout->error;



?>