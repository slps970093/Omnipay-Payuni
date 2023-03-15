<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class CreditCardRequestTest extends TestCase
{
    public function test_credit_card_request()
    {
        $payUniSdk = \Mockery::mock(PayuniApi::class);

        $payUniSdk->shouldReceive('UniversalTrade')
            ->once()
            ->andReturn([
                'message'=> [
                    "Status" => "SUCCESS",
                    "MerID" => "S00641220",
                    "Version" => "1.0",
                    "EncryptInfo" => [
                        "Status" => "SUCCESS",
                        "Message" => "授權成功",
                        "MerID" => "******",
                        "MerTradeNo" => "20230410163436-monkey",
                        "Gateway" => "1",
                        "TradeNo" => "******",
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
                        "AuthTime" => "163436",
                        "CreditHash" => "52947EBD041D7046DB1921FB763BC1F69836852A6AC7BC8B3B7C4FDC472B3BA5",
                        "CreditLife" => "0929"
                    ],
                    "HashInfo" => "65B259BCCC46E3AB29F3B85FB6CF87E890F26079BC622EFEA37117B074A34ABD"
                ]
            ]);

        $params = [
            'MerTradeNo' 		=> "*****",
            'HashKey'			=> '****',
            'HashIV'			=> '****',
            'TradeAmt'   		=> 10,
            'Timestamp'	 		=> time(),
            'CardNo'	 		=> '****',
            'CardCVC'	 		=> '****',
            'CardInst'			=> 1,
            'CardType'			=> 3,
            'CardExpired'		=> '****',
            'CreditToken'		=> time() . "aaaa",
            'notifyUrl'			=> 'https://domain.local/payment/notify',
            'ProdDesc'			=> '嗡嗡翁',
            'CreditTokenType' 	=> 1,
            'UseTokenStatus'  	=> 1,
            'API3D'				=> 1,
            'ServiceType'		=> 3,
            'StoreID'			=> 916712,
            'Consignee'			=> "猴子",
            'ConsigneeMobile'	=> '0955555555',
            'LgsType'			=> 'B2C',
            'GoodsType'			=> 1,
            'ShipType'			=> 1
        ];

        $request = new CreditCardRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->setPayUni($payUniSdk);

        $request->initialize($params);
        $request->setTestMode(true);

        $response = $request->send();

        $expectedApiResult =  [
            "Status" => "SUCCESS",
            "MerID" => "S00641220",
            "Version" => "1.0",
            "EncryptInfo" => [
                "Status" => "SUCCESS",
                "Message" => "授權成功",
                "MerID" => "******",
                "MerTradeNo" => "20230410163436-monkey",
                "Gateway" => "1",
                "TradeNo" => "******",
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
                "AuthTime" => "163436",
                "CreditHash" => "52947EBD041D7046DB1921FB763BC1F69836852A6AC7BC8B3B7C4FDC472B3BA5",
                "CreditLife" => "0929"
            ],
            "HashInfo" => "65B259BCCC46E3AB29F3B85FB6CF87E890F26079BC622EFEA37117B074A34ABD"
        ];

        $this->assertEquals($expectedApiResult, $response->getData());
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals("SUCCESS", $response->getCode());
    }
}
