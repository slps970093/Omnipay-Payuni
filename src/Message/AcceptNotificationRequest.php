<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Payuni\Traits\HasEncrypt;

class AcceptNotificationRequest extends CompletePurchaseRequest implements NotificationInterface
{
    use HasEncrypt;
    /**
     * 交易狀態
     * @return mixed|string
     */
    public function getTransactionStatus()
    {
        // TODO: Implement getTransactionStatus() method.
        return $this->httpRequest->request->all()['Status'];
    }

    /**
     * 取得加密資訊
     * @return array
     */
    public function getData()
    {
        $result = $this->httpRequest->request->all();
        $result['EncryptInfo'] = $this->parseDecrypt();
        return $result;
    }

    /**
     * 交易狀況
     * @return mixed|string
     */
    public function getTransactionReference()
    {
        $data = $this->parseDecrypt();

        return $data['TradeStatus'];
    }

    /**
     * 交易編號
     * @return mixed|string
     */
    public function getTransactionId()
    {
        $data = $this->parseDecrypt();

        return $data['MerTradeNo'];
    }


    /**
     * 解碼
     * @return array
     */
    public function parseDecrypt(): array
    {
        $request = $this->httpRequest->request->all();
        $decrypt = $this->decrypt($request['EncryptInfo'], $this->getParameter('HashKey'), $this->getParameter('HashIV'));
        $encryptInfo = [];

        parse_str($decrypt, $encryptInfo);

        return $encryptInfo;
    }

    public function getMessage()
    {
        $data = $this->parseDecrypt();

        return $data['Message'];
    }
}
