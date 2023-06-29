<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasEncrypt;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasPersonal;
use Omnipay\Payuni\Traits\HasProduct;
use Omnipay\Payuni\Traits\HasTrade;
use Payuni\Sdk\PayuniApi;

class CreditCardRequest extends AbstractRequest
{
    use HasCreditCard;
    use HasMerchant;
    use HasProduct;
    use HasPersonal;
    use HasPayUniApi;
    use HasEncrypt;
    use HasTrade;

    public function sendData($data)
    {
        $response = $this->getPayUni()->UniversalTrade(
            $data,
            'credit'
        );

        return new CreditCardResponse($this, $response['message']);
    }

    public function getData()
    {
        # 加密資訊 這邊放基本共通一定會出現的
        $mergeData = [
            'CardNo' 				=> $this->getParameter('CardNo'),
            'CardCVC'				=> $this->getParameter('CardCVC'),
            'CardInst'				=> $this->getParameter('CardInst'),
            'CardType'				=> $this->getParameter('CardType'),
            'CardExpired' 			=> $this->getParameter('CardExpired'),
            'CreditToken'			=> $this->getParameter('CreditToken'),
            'CreditTokenType'		=> $this->getParameter('CreditTokenType'),
            'CreditTokenExpired'	=> $this->getParameter('CreditTokenExpired'),
            'CreditHash'			=> $this->getParameter('CreditHash'),
            'UseTokenStatus'		=> $this->getParameter('UseTokenStatus'),
            'API3D'					=> $this->getParameter('API3D')
        ];

        $encryptInfo = array_merge(EncryptInfo::getBasicInfo($this->parameters), $mergeData);

        return EncryptInfo::filterNull($encryptInfo);
    }
}
