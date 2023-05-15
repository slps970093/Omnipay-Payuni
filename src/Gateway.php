<?php

namespace Omnipay\Payuni;

use Omnipay\Common\AbstractGateway;
use Omnipay\Payuni\Message\AcceptNotificationRequest;
use Omnipay\Payuni\Message\CompletePurchaseRequest;
use Omnipay\Payuni\Message\CreditCardRequest;
use Omnipay\Payuni\Message\PurchaseRequest;
use Omnipay\Payuni\Message\TradeCancelRequest;
use Omnipay\Payuni\Message\TradeCloseRequest;
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


    public function purchase(array $options = [])
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(PurchaseRequest::class, $data);
    }

    public function completePurchase(array $options = [])
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(CompletePurchaseRequest::class, $data);
    }
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
		return $this->createRequest(TradeCloseRequest::class,$data);
	}

	/**
	 * 交易取消授權
	 * @param array $options
	 * @return \Omnipay\Common\Message\AbstractRequest
	 */
	public function tradeCancel(array $options)
	{
		$data = array_merge($options, $this->getParameters());
		return $this->createRequest(TradeCancelRequest::class,$data);
	}

    public function acceptNotification(array $options)
    {
        $data = array_merge($options, $this->getParameters());
        return $this->createRequest(AcceptNotificationRequest::class, $data);
    }

}
