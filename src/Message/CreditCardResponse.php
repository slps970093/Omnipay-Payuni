<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Payuni\Traits\HasEncrypt;

class CreditCardResponse extends AbstractResponse
{
    use HasEncrypt;
    public function isSuccessful()
    {
        // TODO: Implement isSuccessful() method.
        return strtoupper($this->data['Status']) == "SUCCESS";
    }


    public function getCode()
    {
        return $this->data['Status'];
    }
}
