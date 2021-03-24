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
	            'total'=>10,
                  ],
        'methods'=>[4,5,6,7,8,9],
        'installmentProducts'=>[['name'=>'T-shirt','price'=>10,'quantity'=>1]],
        'returnurl'=>'example.com',
        'preAuth'=>true,
        'language'=>'EN',
        'merchanTBCCheckoutmentId'=>'order#1'
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