# TBC Checkout
Tbc bank payment system [TBCCheckout](https://developers.tbcbank.ge/docs/tpay---web-payments/1/overview).

### Creating object
```php
$TBCCheckout = new TBCCheckout(client_id,client_secret,apikey,debug);
```

client_id and client_secret

In order to execute TBC Checkout Services, requestor must be registered as a TBC Checkout merchant in bank. 
Details regarding registration can be found at https://tbcpayments.ge/details/ecom/tbc

After TBC Checkout merchant account is validated and activated by back office users in TBC Checkout system, 
client_id and client_secret parameters will be generated and accessible by merchant's administrative user via TBC Checkout website at company profile/my sites tab.

apikey

All requests to Open API platform should contain apikey  parameter with corresponding developer app key value  passed in the request Header. apikey parameter is used  
to verify registered developer app and grant general  access to Open API platform. To get your API key, follow instructions at https://developers.tbcbank.ge/get-started


debug 

Debug Information  true enable / false disable