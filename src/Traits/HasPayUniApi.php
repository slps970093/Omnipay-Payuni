<?php

namespace Omnipay\Payuni\Traits;

use Payuni\Sdk\PayuniApi;

trait HasPayUniApi
{
    protected $payUni = null;

    public function setPayUni(PayuniApi $api)
    {
        $this->payUni = $api;
    }

	/**
	 * @return mixed|PayuniApi
	 */
	public function getPayUni()
	{
		if ($this->payUni instanceof PayuniApi) {
			return $this->payUni;
		}
		return $this->payUni = new PayuniApi(
			$this->getParameter("HashKey"),
			$this->getParameter("HashIV"),
			($this->getTestMode()) ? "t" : ""
		);
	}
}
