<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasTrade;

class TradeCancelRequest extends AbstractRequest
{
	use HasMerchant,
		HasCreditCard,
		HasTrade,
		HasPayUniApi;
	public function sendData($data)
	{
		// TODO: Implement sendData() method.
		$api = $this->getPayUni()->UniversalTrade(
			$data,
			'trade_cancel'
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
