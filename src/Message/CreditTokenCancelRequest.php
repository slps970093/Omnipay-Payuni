<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasCreditCard;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasTrade;

class CreditTokenCancelRequest extends AbstractRequest
{
	use HasMerchant,
		HasCreditCard,
		HasPayUniApi,
		HasTrade;
	public function sendData($data)
	{
		// TODO: Implement sendData() method.

		$apiResponse = $this->getPayUni()->UniversalTrade(
			$data,
			'credit_bind_cancel'
		);

		return new CreditTokenResponse($this,$apiResponse['message']);
	}

	public function getData()
	{
		// TODO: Implement getData() method.
		$params = EncryptInfo::getBasicInfo($this->parameters);

		$mergeParams = [
			'MerID' 			=> $this->getParameter('MerID'),
			'BindVal' 			=> $this->getParameter('BindVal'),
			'CreditTokenType'	=> $this->getParameter('CreditTokenType'),
			'UseTokenType'		=> $this->getParameter('UseTokenType'),
			'Timestamp'			=> $this->getParameter('Timestamp')
		];

		return EncryptInfo::filterNull(array_merge($params, $mergeParams));
	}

	/**
	 * 綁定回傳值 / 信用卡 Token
	 * @param $val
	 * @return CreditTokenCancelRequest
	 */
	public function setBindVal($val)
	{
		return $this->setParameter('BindVal', $val);
	}
}
