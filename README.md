# TBC Checkout

Methods for integrating TBC Checkout - card and QR payments for e-commerce merchants 
## Table Of Contents

- [TBC-Checkout documentation](https://developers.tbcbank.ge/docs/tpay---web-payments/1/overview)
- [How to use](#how-to-use)
- [Purchase Form](#purchase-form)
- [Savecard Form](#savecard-form)
- [Completion](#completion)
- [Cancel](#cancel)
- [Execution](#execution)
- [Delete](#delete)
                                  
## How to use

All examples require `composer install` before using after cloning from GitHub.                                  

#### Purchase Form

See [purchase.php](examples/purchase.php).

Run PHP built-in server

```bash
$ php -S localhost:8000
```

Then open `http://localhost:8000/examples/purchase.php` in browser.



#### Savecard Form

See [savecard.php](examples/savecard.php).

Run PHP built-in server

```bash
$ php -S localhost:8000
```

Then open `http://localhost:8000/examples/savecard.php` in browser.



#### Completion

See [completion.php](examples/completion.php).

```bash
$ php examples/completion.php 
Array(
[status] => Succeeded
[amount] => 10
[confirmedAmount] => 10
[httpStatusCode] => 200
[developerMessage] =>
[userMessage] =>
)
```

Response will be instance of `CompletionPayment`. 
Response Types
200: OK


#### Cancel

See [cancel.php](examples/cancel.php).

```bash
$ php examples/cancel.php 
Array(
[httpStatusCode] => 200
[developerMessage] =>
[userMessage] =>
)
```

Response will be instance of `CancelPayment`. 
Response Types
200: OK



#### Execution

See [execution.php](examples/execution.php).

```bash
$ php examples/execution.php 
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
```

Response will be instance of `ExecutionPayment`. 
Response Types
200: OK


#### Delete

See [delete.php](examples/delete.php).

```bash
$ php examples/delete.php 
Array(
[httpStatusCode] => 200
[developerMessage] =>
[userMessage] =>
)
```

Response will be instance of `DeletePayment`. 
Response Types
200: OK

