# 整合式支付頁面 UNiPayPage

## 付款請求

請參考 [文件](https://www.payuni.com.tw/docs/web/#/7/34) 中的請求參數進行帶入動作，寫法如下

```php
<?php
$gateway = \Omnipay\Omnipay::create('Payuni');
$gateway->initialize([
	'MerID'	  => '商店代號',
	'HashKey' => 'API 串接金鑰 HashKey',
	'HashIV'  => 'API 串接金鑰 IV Key',
]);

$request = $gateway->purchase([
/* 帶入 請求參數 */
]);

$request->setNotifyUrl('');// 設定通知URL
$request->setReturlUrl('');// 設定付款後回傳URL

$response = $request->send();

if ($response->isRedirect()) {
	$response->redirect();
}
```
