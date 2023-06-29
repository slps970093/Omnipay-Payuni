<?php

namespace Omnipay\Payuni;

use Omnipay\Common\AbstractGateway;
use Omnipay\Payuni\Message\AcceptNotificationRequest;
use Omnipay\Payuni\Message\CompletePurchaseRequest;
use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Payuni\Message\CreditTokenCancelRequest;
use Omnipay\Payuni\Message\CreditTokenQueryRequest;
use Omnipay\Payuni\Message\PurchaseRequest;
use Omnipay\Payuni\Message\TradeCancelRequest;
use Omnipay\Payuni\Message\TradeCloseRequest;
use Omnipay\Payuni\Message\TradeQueryMultiRequest;
use Omnipay\Payuni\Message\TradeQueryRequest;
use Omnipay\Payuni\Traits\HasMerchant;

class Gateway extends AbstractGateway
{
    use HasMerchant;
    public function getName(): string
    {
        // TODO: Implement getName() method.
        return 'Payuni';
    }

    public function getDefaultParameters()
    {
        return [
            'MerID'			=> '',		// 商店編號
            'HashKey' 		=> '',		// API 串接金鑰	HashKey
            'HashIV'		=> ''		// API 串接金鑰	IV Key
        ];
    }

    /**
     * upp 模式
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = [])
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(PurchaseRequest::class, $data);
    }

    /**
     * 交易成功回傳結果
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\RequestInterface
     */
    public function completePurchase(array $options = [])
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(CompletePurchaseRequest::class, $data);
    }

    /**
     * 信用卡支付（幕後）
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function creditCard(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(CreditCardRequest::class, $data);
    }

    /**
     * 交易請退款
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function tradeClose(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(TradeCloseRequest::class, $data);
    }

    /**
     * 交易取消授權
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function tradeCancel(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(TradeCancelRequest::class, $data);
    }

    /**
     * 信用卡 token 查詢
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function creditTokenQuery(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(CreditTokenQueryRequest::class, $data);
    }

    /**
     * 信用卡 token 取消
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function creditTokenCancel(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(CreditTokenCancelRequest::class, $data);
    }

    /**
     * notify request
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest|\Omnipay\Common\Message\NotificationInterface
     */
    public function acceptNotification(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(AcceptNotificationRequest::class, $data);
    }

    /**
     * 交易查詢
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function tradeQuery(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(TradeQueryRequest::class, $data);
    }

    /**
     * 多筆交易查詢
     * @param array $options
     * @return \Omnipay\Common\Message\AbstractRequest
     */
    public function tradeQueryMulti(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(TradeQueryMultiRequest::class, $data);
    }
}
