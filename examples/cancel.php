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


$payId='iffv0*****t211839';
   
$res = $TBCCheckout->CancelPayment($payId,10);

/*  Result example

Array(
[httpStatusCode] => 200
[developerMessage] =>
[userMessage] =>
)
*/


if (DEBUG)
print_r($res);

if (isset($res['httpStatusCode']))
echo 'Status: ' . $res['httpStatusCode'] . PHP_EOL;



if (DEBUG && !empty($TBCCheckout->error))
echo $TBCCheckout->error;



?>