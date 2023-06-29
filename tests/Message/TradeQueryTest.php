<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\TradeQueryMultiRequest;
use Omnipay\Payuni\Message\TradeQueryRequest;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class TradeQueryTest extends TestCase
{

	public function test_single_query()
	{
		$payUniSdk = \Mockery::mock(PayuniApi::class);

		$payUniSdk->shouldReceive('UniversalTrade')
			->once()
			->andReturn([
				'message'=> [
					"Status" => "SUCCESS",
					"MerID" => "*****",
					"Version" => "1.0",
					"EncryptInfo" => [
						"Status" => "SUCCESS",
						"Message" => "查詢成功",
						"Result" => [
							[
								"MerTradeNo" => "20230629212255-monkey",
								"TradeNo" => "1688044976546407799",
								"TradeAmt" => "10",
								"TradeStatus" => "1",
								"PaymentType" => "1",
								"PaymentDay" => "2023-06-29 21:22:56",
								"CreateDay" => "2023-06-29 21:22:56",
								"Gateway" => "1",
								"Card6No" => "414763",
								"Card4No" => "0001",
								"CardExp" => "0929",
								"CardInst" => "1",
								"AuthCode" => "000000",
								"AuthType" => "1",
								"CardBank" => "812",
								"CloseStatus" => "2",
								"CloseAmt" => "10",
								"RefundType" => "2",
								"RefundStatus" => "2",
								"RefundAmt" => "10",
								"RefundDay" => "2023-06-29 22:03:40",
								"RemainAmt" => "0"
							]
						]
					],
					"HashInfo" => "806E1E946276263272C93A9E9C9A9E29F842E8A7436FF0E7749343EB5941407B"
				]
			]);

		$params = [
			'MerID'			=> '*****',								// 商店編號
			'HashKey' 		=> '*****',		// API 串接金鑰	HashKey
			'HashIV'		=> '*****',						// API 串接金鑰	IV Key
			'testMode' 		=> true,
			'Timestamp'		=> time(),
			'TradeNo'		=> '123456',
		];

		$request = new TradeQueryRequest($this->getHttpClient(), $this->getHttpRequest());

		$request->setPayUni($payUniSdk);

		$request->initialize($params);
		$request->setTestMode(true);

		$response = $request->send();

		$expectedApiResult = [
			"Status" => "SUCCESS",
			"MerID" => "*****",
			"Version" => "1.0",
			"EncryptInfo" => [
				"Status" => "SUCCESS",
				"Message" => "查詢成功",
				"Result" => [
					[
						"MerTradeNo" => "20230629212255-monkey",
						"TradeNo" => "1688044976546407799",
						"TradeAmt" => "10",
						"TradeStatus" => "1",
						"PaymentType" => "1",
						"PaymentDay" => "2023-06-29 21:22:56",
						"CreateDay" => "2023-06-29 21:22:56",
						"Gateway" => "1",
						"Card6No" => "414763",
						"Card4No" => "0001",
						"CardExp" => "0929",
						"CardInst" => "1",
						"AuthCode" => "000000",
						"AuthType" => "1",
						"CardBank" => "812",
						"CloseStatus" => "2",
						"CloseAmt" => "10",
						"RefundType" => "2",
						"RefundStatus" => "2",
						"RefundAmt" => "10",
						"RefundDay" => "2023-06-29 22:03:40",
						"RemainAmt" => "0"
					]
				]
			],
			"HashInfo" => "806E1E946276263272C93A9E9C9A9E29F842E8A7436FF0E7749343EB5941407B"
		];

		$this->assertEquals($expectedApiResult, $response->getData());
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals("SUCCESS", $response->getCode());
	}

	public function test_multi_query()
	{
		$payUniSdk = \Mockery::mock(PayuniApi::class);

		$payUniSdk->shouldReceive('UniversalTrade')
			->once()
			->andReturn([
				'message'=> [
					"Status" => "SUCCESS",
					"MerID" => "*****",
					"Version" => "1.0",
					"EncryptInfo" => [
						"Status" => "SUCCESS",
						"Message" => "查詢成功",
						"Result" => [
							[
								"MerTradeNo" => "20230629212255-monkey",
								"TradeNo" => "1688044976546407799",
								"TradeAmt" => "10",
								"TradeStatus" => "1",
								"PaymentType" => "1",
								"PaymentDay" => "2023-06-29 21:22:56",
								"CreateDay" => "2023-06-29 21:22:56",
								"Gateway" => "1",
								"Card6No" => "414763",
								"Card4No" => "0001",
								"CardExp" => "0929",
								"CardInst" => "1",
								"AuthCode" => "000000",
								"AuthType" => "1",
								"CardBank" => "812",
								"CloseStatus" => "2",
								"CloseAmt" => "10",
								"RefundType" => "2",
								"RefundStatus" => "2",
								"RefundAmt" => "10",
								"RefundDay" => "2023-06-29 22:03:40",
								"RemainAmt" => "0"
							]
						]
					],
					"HashInfo" => "806E1E946276263272C93A9E9C9A9E29F842E8A7436FF0E7749343EB5941407B"
				]
			]);

		$params = [
			'MerID'			=> '*****',								// 商店編號
			'HashKey' 		=> '*****',		// API 串接金鑰	HashKey
			'HashIV'		=> '*****',						// API 串接金鑰	IV Key
			'testMode' 		=> true,
			'Timestamp'		=> time(),
			'QueryNo'		=> '123456',
		];

		$request = new TradeQueryMultiRequest($this->getHttpClient(), $this->getHttpRequest());

		$request->setPayUni($payUniSdk);

		$request->initialize($params);
		$request->setTestMode(true);

		$response = $request->send();

		$expectedApiResult = [
			"Status" => "SUCCESS",
			"MerID" => "*****",
			"Version" => "1.0",
			"EncryptInfo" => [
				"Status" => "SUCCESS",
				"Message" => "查詢成功",
				"Result" => [
					[
						"MerTradeNo" => "20230629212255-monkey",
						"TradeNo" => "1688044976546407799",
						"TradeAmt" => "10",
						"TradeStatus" => "1",
						"PaymentType" => "1",
						"PaymentDay" => "2023-06-29 21:22:56",
						"CreateDay" => "2023-06-29 21:22:56",
						"Gateway" => "1",
						"Card6No" => "414763",
						"Card4No" => "0001",
						"CardExp" => "0929",
						"CardInst" => "1",
						"AuthCode" => "000000",
						"AuthType" => "1",
						"CardBank" => "812",
						"CloseStatus" => "2",
						"CloseAmt" => "10",
						"RefundType" => "2",
						"RefundStatus" => "2",
						"RefundAmt" => "10",
						"RefundDay" => "2023-06-29 22:03:40",
						"RemainAmt" => "0"
					]
				]
			],
			"HashInfo" => "806E1E946276263272C93A9E9C9A9E29F842E8A7436FF0E7749343EB5941407B"
		];

		$this->assertEquals($expectedApiResult, $response->getData());
		$this->assertTrue($response->isSuccessful());
		$this->assertEquals("SUCCESS", $response->getCode());
	}
}
