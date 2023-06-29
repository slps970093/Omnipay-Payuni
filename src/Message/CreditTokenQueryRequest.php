<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasTrade;

class CreditTokenQueryRequest extends AbstractRequest
{
    use HasMerchant;
    use HasCreditCard;
    use HasPayUniApi;
    use HasTrade;
    public function sendData($data)
    {
        // TODO: Implement sendData() method.

        $apiResponse = $this->getPayUni()->UniversalTrade(
            $data,
            'credit_bind_query'
        );

        return new CreditTokenResponse($this, $apiResponse['message']);
    }

    public function getData()
    {
        // TODO: Implement getData() method.
        $params = EncryptInfo::getBasicInfo($this->parameters);

        $mergeParams = [
            'MerID' 			=> $this->getParameter('MerID'),
            'CreditToken' 		=> $this->getParameter('CreditToken'),
            'CreditTokenType'	=> $this->getParameter('CreditTokenType'),
            'CreditHash'		=> $this->getParameter('CreditHash'),
            'Timestamp'			=> $this->getParameter('Timestamp')
        ];

        return EncryptInfo::filterNull(array_merge($params, $mergeParams));
    }
}
