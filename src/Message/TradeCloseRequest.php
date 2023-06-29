<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasTrade;

class TradeCloseRequest extends AbstractRequest
{
    use HasMerchant;
    use HasCreditCard;
    use HasTrade;
    use HasPayUniApi;
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
        $api = $this->getPayUni()->UniversalTrade(
            $data,
            'trade_close'
        );

        return new TradeResponse($this, $api['message']);
    }

    public function getData()
    {
        // TODO: Implement getData() method.
        $basicData = EncryptInfo::getBasicInfo($this->parameters);

        $mergeData = [
            'TradeNo' => $this->getParameter('TradeNo'),
            'CloseType' => $this->getParameter('CloseType')
        ];

        return EncryptInfo::filterNull(array_merge($basicData, $mergeData));
    }
}
