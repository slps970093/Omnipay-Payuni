<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Payuni\Message\TradeCloseRequest;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class TradeCloseTest extends TestCase
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
                        "TradeNo" => "******",
                        "CloseType" => "10",
                    ],
                    "HashInfo" => "*****"
                ]
            ]);

        $params = [
            'MerTradeNo' 		=> "*****",
            'HashKey'			=> '****',
            'HashIV'			=> '****',
            'MerID'         	=> "HAHA",
            'TradeAmt'   		=> 10,
            'Timestamp'			=> time(),
            'CloseType'			=> 2
        ];

        $request = new TradeCloseRequest($this->getHttpClient(), $this->getHttpRequest());

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
                "TradeNo" => "******",
                "CloseType" => "10",
            ],
            "HashInfo" => "*****"
        ];

        $this->assertEquals($expectedApiResult, $response->getData());
        $this->assertTrue($response->isSuccessful());
        $this->assertEquals("SUCCESS", $response->getCode());
    }
}
