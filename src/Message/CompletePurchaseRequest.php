<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Payuni\Traits\HasMerchant;

class CompletePurchaseRequest extends AbstractRequest
{
    use HasMerchant;
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
        return new CompletePurchaseResponse($this, $data);
    }

    public function getData()
    {
        // TODO: Implement getData() method.
        return $this->httpRequest->request->all();
    }
}
