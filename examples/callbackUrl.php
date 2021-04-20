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

require dirname(__FILE__) . '/../src/TBCCheckout.php';

$postdata = file_get_contents("php://input");
$data=json_decode($postdata,true);

if (isset($data['PaymentId'])){

$TBCCheckout = new TBCCheckout(CLIEND_ID,CLIENT_SECRET,APIKEY,DEBUG);

 $res = $TBCCheckout->GetPaymentInfo($_REQUEST['PaymentId']);
 
 if ($res['status']=='Created'){
    // Activate  payment status in  your system
    header("HTTP/1.1 200 OK"); 
    exit;
 }

 if ($res['status']=='Succeeded'){
   // Activate  payment status in  your system
    header("HTTP/1.1 200 OK"); 
    exit;
 }

 if ($res['status']=='Failed'){
   // Activate  payment status in  your system
    header("HTTP/1.1 200 OK"); 
    exit;
 }

 if ($res['status']=='Returned'){
    // Activate  payment status in  your system
    header("HTTP/1.1 200 OK"); 
    exit;    
 }


 if ($res['status']=='Expired'){
    // Activate  payment status in  your system
    header("HTTP/1.1 200 OK"); 
    exit;
 }

if (DEBUG)
echo $TBCCheckout->error;

}


header("HTTP/1.1 404 Not Found"); 


?>