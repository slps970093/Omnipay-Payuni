<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\AcceptNotificationRequest;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Tests\TestCase;

class AcceptNotificationRequestTest extends TestCase
{
    use HasEncrypt;

    public function test_accept_notification_request()
    {
        $httpRequest = $this->getHttpRequest();

        $hashKey = "monkey";
        $hashIV	 = "666666";

        $encryptInfo = [
            "Status" => "SUCCESS",
            "Message" => "授權成功",
            "MerID" => "******",
            "MerTradeNo" => "20230410233813-monkey",
            "Gateway" => "2",
            "TradeNo" => "1681141130102357013",
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
            "AuthTime" => "233850"
        ];

        $encryptInfoStr = $this->encrypt($encryptInfo, $hashKey, $hashIV);
        $hashInfoStr = $this->hashInfo($encryptInfoStr, $hashKey, $hashIV);

        $httpPostData = [
            "Status" 		=> "SUCCESS",
            "MerID" 		=> "*****",
            "Version" 		=> "1.0",
            "EncryptInfo" 	=> $encryptInfoStr,
            "HashInfo"		=> $hashInfoStr
        ];

        $httpRequest->initialize([], $httpPostData);

        $acceptNotification = new AcceptNotificationRequest(
            $this->getHttpClient(),
            $httpRequest
        );

        $acceptNotification->initialize([
            "HashKey" => $hashKey,
            "HashIV"  => $hashIV
        ]);

        $this->assertEquals([
            "Status" 		=> $httpPostData["Status"],
            "MerID" 		=> $httpPostData["MerID"],
            "Version" 		=> $httpPostData["Version"],
            "EncryptInfo"	=> $encryptInfo,
            "HashInfo"		=> $hashInfoStr
        ], $acceptNotification->getData());

        $this->assertEquals('SUCCESS', $acceptNotification->getTransactionStatus());
        $this->assertEquals($encryptInfo['TradeStatus'], $acceptNotification->getTransactionReference());
        $this->assertEquals($encryptInfo['MerTradeNo'], $acceptNotification->getTransactionId());
        $this->assertEquals($encryptInfo['Message'], $acceptNotification->getMessage());
    }
}
