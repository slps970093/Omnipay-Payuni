<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Payuni\Traits\HasEncrypt;

class CompletePurchaseResponse extends AbstractResponse
{
    use HasEncrypt;
    public function isSuccessful()
    {
        // TODO: Implement isSuccessful() method.
        return $this->data['Status'] == "SUCCESS";
    }

    public function getCode()
    {
        return $this->data['Status'];
    }

    /**
     * 解碼
     * @return array
     */
    private function parseDecrypt(): array
    {
        $decrypt = $this->decrypt(
            $this->data['EncryptInfo'],
            $this->getRequest()->getParameters()['HashKey'],
            $this->getRequest()->getParameters()['HashIV']
        );

        $encryptInfo = [];

        parse_str($decrypt, $encryptInfo);

        return $encryptInfo;
    }

    /**
     * 取得回傳資料
     * @return array
     */
    public function getData(): array
    {
        $rtnData = $this->data;

        $rtnData['EncryptInfo'] = $this->parseDecrypt();

        return $rtnData;
    }

    public function getMessage()
    {
        $data = $this->parseDecrypt();

        return $data['Message'];
    }
}
