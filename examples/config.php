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



/*
* In order to execute TBC Checkout Services, requestor must be registered as a TBC Checkout merchant in bank. 
* Details regarding registration can be found at https://tbcpayments.ge/details/ecom/tbc
*
* After TBC Checkout merchant account is validated and activated by back office users in TBC Checkout system, 
* client_id and client_secret parameters will be generated and accessible by merchant's administrative user via TBC Checkout website at company profile/my sites tab.
*/

define('CLIEND_ID', 'client_id');
define('CLIENT_SECRET','client_secret');


/*
* All requests to Open API platform should contain apikey  parameter with corresponding developer app key value  passed in the request Header. apikey parameter is used  
* to verify registered developer app and grant general  access to Open API platform. To get your API key, follow instructions at https://developers.tbcbank.ge/get-started
*/

define('APIKEY', 'apikey');


/*
*enable or disable debugger information
*/

define('DEBUG', TRUE);


?>