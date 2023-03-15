<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\CompletePurchaseRequest;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Tests\TestCase;

class CompletePurchaseRequestTest extends TestCase
{
    use HasEncrypt;

    public function test_complete_purchase()
    {
        $httpRequest = $this->getHttpRequest();

        $hashKey = "monkey";
        $hashIV	 = "666666";

        $encryptInfo = [
            "Status" => "SUCCESS",
            "Message" => "授權成功",
            "MerID" => "*****",
            "MerTradeNo" => "20230410230345-monkey",
            "Gateway" => "2",
            "TradeNo" => "1681139046835596783",
            "TradeAmt" => "10",
            "TradeStatus" => "1",
            "PaymentType" => "1",
            "CardBank" => "812",
            "Card6No" => "414763",
            "Card4No" => "0001",
            "CardInst" => "1",
            "FirstAmt" => "10",
            "EachAmt" => "0",
            "ResCode" => "00",
            "ResCodeMsg" => "授權成功(模擬)",
            "AuthCode" => "000000",
            "AuthBank" => "812",
            "AuthBankName" => "台新國際商業銀行",
            "AuthType" => "1",
            "AuthDay" => "20230410",
            "AuthTime" => "230406"
        ];

        $encryptInfoStr = $this->encrypt($encryptInfo, $hashKey, $hashIV);
        $hashInfoStr = $this->hashInfo($encryptInfoStr, $hashKey, $hashIV);

        $postData = [
            "Status" => "SUCCESS",
            "MerID" => "*******",
            "Version" => "1.0",
            "EncryptInfo" => $encryptInfoStr,
            "HashInfo" => $hashInfoStr
        ];

        $httpRequest->initialize([], $postData);

        $completePurchase = new CompletePurchaseRequest(
            $this->getHttpClient(),
            $httpRequest
        );

        $completePurchase->initialize([
            "HashKey" => $hashKey,
            "HashIV"  => $hashIV
        ]);

        $response = $completePurchase->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals("SUCCESS", $response->getCode());
        $this->assertEquals([
            "Status" => "SUCCESS",
            "MerID" => "*******",
            "Version" => "1.0",
            "EncryptInfo" => $encryptInfo,
            "HashInfo" => $hashInfoStr
        ], $response->getData());
        $this->assertEquals('授權成功', $response->getMessage());
    }
}
