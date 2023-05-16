<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Payuni\Message\CreditTokenCancelRequest;
use Omnipay\Payuni\Message\CreditTokenQueryRequest;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class CreditTokenCancelTest extends TestCase
{
	use HasEncrypt;

	public function test_credit_card_cancel_request()
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
			'BindVal'   		=> '****',
			'CreditTokenType'	=> 1,
			'UseTokenType'		=> 1,
			'ProdDesc'			=> '嗡嗡翁'
		];

		$request = new CreditTokenCancelRequest($this->getHttpClient(), $this->getHttpRequest());

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
			],
			"HashInfo" => "BB62CB54ED11121B1A8C6ACDAAED649B111B6F15557DC04D86DCD336EC433399"
		];

		$this->assertEquals($expectedApiResult, $response->getData());
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals("SUCCESS", $response->getCode());
	}
}
