<?php
/*
* This file is part of the TBCCheckout project.
*
* Detailed instructions can be found in README.md or online
* @link https://github.com/Geopaysoft/TBCCheckout
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


$res = $TBCCheckout->DeletePayment('E95011edFFFc4D4E81C936493bD154B7');


/*
Result example
 

Array
(
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