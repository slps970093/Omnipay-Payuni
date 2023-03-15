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
}
