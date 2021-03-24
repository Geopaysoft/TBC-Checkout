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

/**
 * Class TBCCheckout
*/

class TBCCheckout {

/**
 * @var Endpoint Addresses
*/
const URL  = 'https://api.tbcbank.ge/v1/tpay/';

/**
 * @var  The access token value
*/
private  $access_token = NULL;

/**
 * @var bool Debug Mode
*/
private  $debug = FALSE;

/**
 * @var string TBC Open Api Key
*/
private  $apikey;

/**
 * @var string Error status property
*/
public $error = NULL;

/**
* TBCCheckout constructor.
*
* @param number client_id     - client id (Merchant Id registered in TBC-Checkout system).
* @param string client_secret - client secret for accessing TBC-Checkout resources.
* @param string apiKey        - TBC Open Api Key, Generated on developers.tbcbank.ge.
* @param bool   debug         - Debug Mode default false.
*/
public function __construct($client_id,$client_secret,$apiKey,$debug=FALSE){

    $this->debug=(bool)$debug;
    $this->apikey=$apiKey;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST,TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,['Content-Type: application/x-www-form-urlencoded','apiKey: '.$this->apikey]);
    curl_setopt($curl, CURLOPT_POSTFIELDS,rawurldecode(http_build_query(['client_id'=>$client_id,'client_secret'=>$client_secret])));
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,30);
    curl_setopt($curl, CURLOPT_VERBOSE,$this->debug);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,'0');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,'0');
    curl_setopt($curl, CURLOPT_URL, self::URL.'access-token');
            
    $res = curl_exec($curl);

     if($res === FALSE){ 
        $this->error=curl_error($curl);
        curl_close($curl);
        return false;
     }
    
     curl_close($curl);
     $res_object=json_decode($res);

     if(isset($res_object->access_token) && !empty($res_object->access_token) && isset($res_object->token_type) && strtolower($res_object->token_type)=='bearer' ){
        $this->access_token = $res_object->access_token;  
        return true;
     }
     else    
        $this->error=$res;
        
}

/*
* Send POST request
* @param string $URL Endpoint Addresses
* @param array $data
* @return ServiceResponse
*/
private function Request($URL,$data){
 if (!is_array($data)){
     $this->error='Error in data structure';
     return false;
    }

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST,TRUE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,['Content-Type: application/json; charset=utf-8','Authorization: Bearer '.$this->access_token,'ApiKey: '.$this->apikey]);
    curl_setopt($curl, CURLOPT_VERBOSE,$this->debug);
    curl_setopt($curl, CURLOPT_POSTFIELDS,json_encode($data));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
    curl_setopt($curl, CURLOPT_URL, $URL);
            
    $res = curl_exec($curl);
  
    if($res === FALSE){
      $this->error=curl_error($curl);
      curl_close($curl);
     return false;
    }
  
   curl_close($curl);
   $res_object=json_decode($res,true);            

   if(!is_array($res_object)){
       $this->error=$res;
       return [];
   }

  return $res_object;
}



/*
* Request returns payment status and details for given payment-id.
* @param string $paymentid TBC-Checkout payment identifier
* @return ServiceResponse
*/
public function GetPaymentInfo($paymentid){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
    curl_setopt($curl, CURLOPT_HTTPHEADER,['Content-Type: application/json','Authorization: Bearer '.$this->access_token,'ApiKey: '.$this->apikey]);
    curl_setopt($curl, CURLOPT_VERBOSE,$this->debug);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, '0');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, '0');
    curl_setopt($curl, CURLOPT_URL, self::URL.'payments/'.$paymentid);
            
    $res = curl_exec($curl);
  
    if($res === FALSE){
      $this->error=curl_error($curl);
      curl_close($curl);
     return false;
    }
  
   curl_close($curl);
   $res_object=json_decode($res,true);            

   if(!is_array($res_object)){
       $this->error=$res;
       return [];
   }

  return $res_object;
}

/*
* Request initiates TBC-Checkout web payment. The response contains payment object details and links for a) checking payment status and b) redirecting user to finish initiated payment.
* @param array $param
* @return ServiceResponse
*/
public function RequestPayment($param){

 return $this->Request(self::URL.'payments',$param);

}

/**
* Request completes authorization process for payment with given payment_id. 
* @param string $paymentid TBC-Checkout payment identifier
* @param number $amount amount to be confirmed (should not exceed transaction amount). if confirmed amount is less than the original transaction amount, difference is automatically returned to the customer.
* @return ServiceResponse
*/
public function CompletionPayment($paymentid,$amount){

 return $this->Request(self::URL.'payments/'.$paymentid.'/completion',['amount'=>$amount]);

}

/**
* Request cancels payment for given payment_id.
* @param string $paymentid TBC-Checkout payment identifier
* @param number $amount amount to be returned (should not exceed transaction amount)
* @return ServiceResponse
*/
public function CancelPayment($paymentid,$amount){

 return $this->Request(self::URL.'payments/'.$paymentid.'/cancel',['amount'=>$amount]);

}

/**
* Request deletes recurring payment for given rec_id.
* @param string $rec_id recurring payment identifier
* @return ServiceResponse
*/
public function DeletePayment($rec_id){

 return $this->Request(self::URL.'payments/'.$rec_id.'/delete',[]);

}

/**
* Request initiates recurring payment.
* @param array $param
* @return ServiceResponse
*/
public function ExecutionPayment($param){

 return $this->Request(self::URL.'payments/execution',$param);

}

} // End off class

?>