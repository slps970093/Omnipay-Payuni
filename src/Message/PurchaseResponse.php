<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;

class PurchaseResponse extends AbstractResponse
{
	public function isSuccessful()
	{
		// TODO: Implement isSuccessful() method.
		return true;
	}

	public function getData()
	{
		return $this->data;
	}
}
