<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;
use Omnipay\Payuni\Traits\HasEncrypt;

class PeriodPageResponse extends AbstractResponse implements RedirectResponseInterface
{
	use HasEncrypt;
	public function isSuccessful()
	{
		// TODO: Implement isSuccessful() method.
		return false;
	}

	public function isRedirect()
	{
		return true;
	}

	public function getRedirectMethod()
	{
		return 'POST';
	}

	public function getRedirectUrl()
	{
		return ($this->data['testMode'] === true) ?
			"https://sandbox-api.payuni.com.tw/api/period/Page" :
			"https://api.payuni.com.tw/api/period/Page";
	}

	public function getRedirectData()
	{
		$formData = $this->data;

		$merId = $formData['MerID'];

		unset($formData['testMode']);
		unset($formData['HashKey']);
		unset($formData['HashIV']);


		$encrypt = $this->encrypt($formData, $this->data['HashKey'], $this->data['HashIV']);

		return [
			'MerID' => $merId,
			'Version' => '1.0',
			'EncryptInfo' => $encrypt,
			'HashInfo' => $this->hashInfo($encrypt, $this->data['HashKey'], $this->data['HashIV'])
		];
	}
}
