<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Payuni\Traits\HasExpire;
use Omnipay\Payuni\Traits\HasLogistics;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPersonal;
use Omnipay\Payuni\Traits\HasProduct;
use Omnipay\Payuni\Traits\HasTrade;
use Omnipay\Payuni\Traits\HasUNiPayPage;
use Payuni\Sdk\PayuniApi;

class PurchaseRequest extends AbstractRequest
{
    use HasMerchant;
    use HasCreditCard;
    use HasProduct;
    use HasExpire;
    use HasEncrypt;
    use HasPersonal;
    use HasLogistics;
    use HasUNiPayPage;
    use HasTrade;

    public function sendData($data)
    {
        return new PurchaseResponse($this, $data);
    }

    public function getData(): array
    {
        // TODO: Implement getData() method.
		$mergeData = [
			# 附加額外資料
			"UsrMailFix"			=> $this->getParameter('UsrMailFix'),
			"UseTokenType"			=> $this->getParameter('UseTokenType'),
			"UseTokenStatus" 		=> $this->getParameter('UseTokenStatus'),
			"CreditTokenType"		=> $this->getParameter('CreditTokenType'),
			"CreditTokenExpired" 	=> $this->getParameter('CreditTokenExpired'),
			"ExpireDate"			=> $this->getParameter('ExpireDate'),
			"TradeLExpireSec"		=> $this->getParameter('TradeLExpireSec'),
			"Credit"				=> $this->getParameter('Credit'),
			"ICash"					=> $this->getParameter('ICash'),
			"Aftee"					=> $this->getParameter('Aftee'),
			"ATM"					=> $this->getParameter('ATM'),
			"CVS"					=> $this->getParameter('CVS'),
			"CreditUnionPay"		=> $this->getParameter('CreditUnionPay'),
			"CreditRed"				=> $this->getParameter('CreditRed'),
			"CreditInst"			=> $this->getParameter('CreditInst'),
			"ApplePay"				=> $this->getParameter('ApplePay'),
			"Ship"					=> $this->getParameter('Ship'),
			"ShipTag"				=> $this->getParameter('ShipTag'),
			"LgsType"				=> $this->getParameter('LgsType'),
			"GoodsType"				=> $this->getParameter('GoodsType'),
			"Consignee"				=> $this->getParameter('Consignee'),
			"ConsigneeMobile"		=> $this->getParameter('ConsigneeMobile')
		];
        $encryptInfo = array_merge(EncryptInfo::getBasicInfo($this->parameters), $mergeData);

        # 加解密 and hash
        # @see https://www.payuni.com.tw/docs/web/#/7/56
        $encryptInfoStr = $this->encrypt(
            EncryptInfo::filterNull($encryptInfo),
            $this->getParameter("HashKey"),
            $this->getParameter("HashIV")
        );

        $hashInfo = $this->hashInfo(
            $encryptInfoStr,
            $this->getParameter("HashKey"),
            $this->getParameter("HashIV")
        );

        return [
            "MerID"         => $this->getParameter('MerID'),
            "Version"		=> "1.0",
            "EncryptInfo"	=> $encryptInfoStr,
            "HashInfo"		=> $hashInfo
        ];
    }

}
