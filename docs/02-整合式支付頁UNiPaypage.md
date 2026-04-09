# 整合式支付頁面 UNiPayPage

## 付款請求

請參考 [文件](https://www.payuni.com.tw/docs/web/#/7/34) 中的請求參數進行帶入動作，寫法如下

```php
<?php
$gateway = \Omnipay\Omnipay::create('Payuni');
$gateway->initialize([
    'MerID'   => '商店代號',
    'HashKey' => 'API 串接金鑰 HashKey',
    'HashIV'  => 'API 串接金鑰 IV Key',
]);

$request = $gateway->purchase([
    'MerTradeNo' => '訂單編號',
    'TradeAmt'   => 100,
    'Timestamp'  => time(),
    'ProdDesc'   => '商品描述',
    /* 其他請求參數 */
]);

$request->setNotifyUrl('https://your-domain.com/payment/notify'); // 設定非同步通知 URL
$request->setReturnUrl('https://your-domain.com/payment/return'); // 設定付款後跳轉 URL

$response = $request->send();

// send() 會透過 PayuniApi SDK 產生付款表單 HTML，直接輸出即可
echo $response->getData();
```

> `send()` 內部使用 `PayuniApi::UniversalTrade()` 產生含自動提交表單的 HTML，
> 輸出後瀏覽器會自動 POST 至 PAYUNi 付款頁面，無需手動呼叫 `redirect()`。

## 測試模式

```php
$request->setTestMode(true); // 切換至 sandbox 環境
```

啟用後 SDK 會自動對應至 `https://sandbox-api.payuni.com.tw/api/upp`。

## 注入自訂 PayuniApi 實例（選用）

如需自行控制 SDK 實例（例如測試時注入 mock），可使用 `setPayUni()`：

```php
$request->setPayUni($yourPayuniApiInstance);
```
