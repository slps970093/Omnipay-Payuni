<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Payuni\Message\CreditTokenQueryRequest;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class CreditTokenQueryTest extends TestCase
{
	use HasEncrypt;

	public function test_credit_card_query_request()
	{
		$payUniSdk = \Mockery::mock(PayuniApi::class);

		$payUniSdk->shouldReceive('UniversalTrade')
			->once()
			->andReturn([
				'message'=>  [
					"Status" => "SUCCESS",
					"MerID" => "S00641220",
					"Version" => "1.0",
					"EncryptInfo" => [
						"Status" => "SUCCESS",
						"Message" => "查詢成功",
						"Result" => [
							[
								"CreditHash" => "8A1339A91429EFC9349C1F12BD491BDA1C128D1F7A849B5AA7BBC36675751964",
								"CreditToken" => "4_SvWmAYziw4",
								"CreditTokenType" => "1",
								"CreditTokenExpired" => "0128",
								"CreditTokenStatus" => "1",
								"Card6No" => "414763",
								"Card4No" => "0001",
								"CardExpiredDT" => "0128"
							]
						]
					],
					"HashInfo" => "BB62CB54ED11121B1A8C6ACDAAED649B111B6F15557DC04D86DCD336EC433399"
				]
			]);

		$params = [
			'MerTradeNo' 		=> "*****",
			'HashKey'			=> '****',
			'HashIV'			=> '****',
			'TradeAmt'   		=> 10,
			'Timestamp'	 		=> time(),
			'CreditToken'   	=> '***',
			'CreditTokenType'	=> 1,
			'notifyUrl'			=> 'https://domain.local/payment/notify',
			'ProdDesc'			=> '嗡嗡翁'
		];

		$request = new CreditTokenQueryRequest($this->getHttpClient(), $this->getHttpRequest());

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
				"Message" => "查詢成功",
				"Result" => [
					[
						"CreditHash" => "8A1339A91429EFC9349C1F12BD491BDA1C128D1F7A849B5AA7BBC36675751964",
						"CreditToken" => "4_SvWmAYziw4",
						"CreditTokenType" => "1",
						"CreditTokenExpired" => "0128",
						"CreditTokenStatus" => "1",
						"Card6No" => "414763",
						"Card4No" => "0001",
						"CardExpiredDT" => "0128"
					]
				]
			],
			"HashInfo" => "BB62CB54ED11121B1A8C6ACDAAED649B111B6F15557DC04D86DCD336EC433399"
		];

		$this->assertEquals($expectedApiResult, $response->getData());
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals("SUCCESS", $response->getCode());
	}
}
