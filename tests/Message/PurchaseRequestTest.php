<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    public function test_upp_request()
    {
        $params = [
            'HashKey'       		=> 'HelloWorld',
            'HashIV'        		=> 'monkey',
            'MerID'         		=> "HAHA",
            'tradeType'     		=> 'upp',
            'MerTradeNo'    		=> 'NYKD-54',
            'TradeAmt'      		=> 81000,
            'Timestamp'     		=> time(),
            'returnUrl'				=> 'http://xxx.com',
            'notifyUrl'	    		=> 'https://domain.local/payment/notify',
            'BackURL'				=> 'https://domain.local/payment/notify',
            'UsrMail'				=> 'tt@gmail.com',
            'UsrMailFix'			=> 1,
            'UseTokenType'  		=> 1,
            'UseTokenStatus' 		=> 1,
            'CreditShowType'		=> 1,
            'CreditToken'			=> 1,
            'ProdDesc'				=> "HAHA",
            'CreditTokenType'		=> "1",
            'CreditTokenExpired' 	=> "0324",
            'ExpireDate'			=> date('Y-m-d'),
            'TradeLExpireSec'		=> 600,
            'Credit'				=> 1,
            'ICash'					=> 1,
            'Aftee'					=> 1,
            'ATM'					=> 1,
            'CVS'					=> 1,
            'CreditUnionPay'		=> 1,
            'CreditRed'				=> 1,
            'CreditInst'			=> 3,
            'ApplePay'				=> 1,
            'Ship'					=> 1,
            'ShipTag'				=> 1,
            'LgsType'				=> "B2C",
            'GoodsType'				=> 1,
            'Consignee'				=> '猴子',
            'ConsigneeMobile'		=> '0955777777'
        ];
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());

        $request->initialize($params);
        $request->setTestMode(true);

        $keyList = [
            "MerID",
            "Version",
            "EncryptInfo",
            "HashInfo"
        ];

        foreach ($keyList as $keyName) {
            $this->assertArrayHasKey($keyName, $request->getData());
        }

        $response = $request->send();

        $this->assertTrue($response->isRedirect());
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isPending());
        $this->assertEquals("https://sandbox-api.payuni.com.tw/api/upp", $response->getRedirectUrl());
        $this->assertEquals("POST", $response->getRedirectMethod());
        $this->assertEquals(['MerID','Version','EncryptInfo','HashInfo'], array_keys($response->getRedirectData()));
    }


}
