<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;

class TradeQueryResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        // TODO: Implement isSuccessful() method.
        return strtoupper($this->data['Status']) == "SUCCESS";
    }

    public function getCode()
    {
        return $this->data['Status'];
    }

    public function getMessage()
    {
        return $this->data['EncryptInfo']['Message'];
    }
}
