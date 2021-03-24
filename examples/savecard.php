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


$param= [
        'amount'=>[
	            'currency'=>'GEL',
	            'total'=>0,
                  ],
        'methods'=>[5],
        'returnurl'=>'example.com',
        'preAuth'=>false,
        'language'=>'EN',
        'merchanTBCCheckoutmentId'=>'order#1',
        'saveCard'=>true,
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