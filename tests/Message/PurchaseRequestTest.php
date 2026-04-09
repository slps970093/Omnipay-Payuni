<?php

namespace Omnipay\Payuni\Tests\Message;

use Omnipay\Payuni\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;
use Payuni\Sdk\PayuniApi;

class PurchaseRequestTest extends TestCase
{
    private array $params = [
        'HashKey'            => 'HelloWorld',
        'HashIV'             => 'monkey',
        'MerID'              => "HAHA",
        'tradeType'          => 'upp',
        'MerTradeNo'         => 'NYKD-54',
        'TradeAmt'           => 81000,
        'Timestamp'          => 1700000000,
        'returnUrl'          => 'http://xxx.com',
        'notifyUrl'          => 'https://domain.local/payment/notify',
        'BackURL'            => 'https://domain.local/payment/notify',
        'UsrMail'            => 'tt@gmail.com',
        'UsrMailFix'         => 1,
        'UseTokenType'       => 1,
        'UseTokenStatus'     => 1,
        'CreditShowType'     => 1,
        'CreditToken'        => 1,
        'ProdDesc'           => "HAHA",
        'CreditTokenType'    => "1",
        'CreditTokenExpired' => "0324",
        'ExpireDate'         => '2025-01-01',
        'TradeLExpireSec'    => 600,
        'Credit'             => 1,
        'ICash'              => 1,
        'Aftee'              => 1,
        'ATM'                => 1,
        'CVS'                => 1,
        'CreditUnionPay'     => 1,
        'CreditRed'          => 1,
        'CreditInst'         => 3,
        'ApplePay'           => 1,
        'Ship'               => 1,
        'ShipTag'            => 1,
        'LgsType'            => "B2C",
        'GoodsType'          => 1,
        'Consignee'          => '猴子',
        'ConsigneeMobile'    => '0955777777',
    ];

    private function makeRequest(bool $testMode = true): PurchaseRequest
    {
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize($this->params);
        $request->setTestMode($testMode);
        return $request;
    }

    public function test_getData_returns_required_keys()
    {
        $request = $this->makeRequest();

        $data = $request->getData();

        foreach (['MerID', 'Version', 'EncryptInfo', 'HashInfo'] as $key) {
            $this->assertArrayHasKey($key, $data);
        }

        $this->assertEquals('HAHA', $data['MerID']);
        $this->assertEquals('1.0', $data['Version']);
        $this->assertNotEmpty($data['EncryptInfo']);
        $this->assertNotEmpty($data['HashInfo']);
    }

    public function test_send_uses_payuni_api()
    {
        $request = $this->makeRequest();

        $fakeHtml = '<form action="https://sandbox-api.payuni.com.tw/api/upp" method="POST">'
            . '<input type="hidden" name="MerID" value="HAHA">'
            . '<input type="hidden" name="Version" value="1.0">'
            . '<input type="hidden" name="EncryptInfo" value="abc">'
            . '<input type="hidden" name="HashInfo" value="def">'
            . '</form>';

        $mockApi = $this->createMock(PayuniApi::class);
        $mockApi->expects($this->once())
            ->method('UniversalTrade')
            ->willReturn($fakeHtml);

        $request->setPayUni($mockApi);

        $response = $request->send();

        $this->assertInstanceOf(\Omnipay\Payuni\Message\PurchaseResponse::class, $response);
    }

    public function test_getPayUni_creates_sandbox_instance_in_test_mode()
    {
        $request = $this->makeRequest(true);

        $api = $request->getPayUni();

        $this->assertInstanceOf(PayuniApi::class, $api);
    }

    public function test_getPayUni_reuses_injected_instance()
    {
        $request = $this->makeRequest();

        $mockApi = $this->createMock(PayuniApi::class);
        $request->setPayUni($mockApi);

        $this->assertSame($mockApi, $request->getPayUni());
    }
}
