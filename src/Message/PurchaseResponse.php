<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{
    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     * Is the response successful?
     *
     * @return bool
     */
    public function isPending()
    {
        return true;
    }

    /**
     * Does the response require a redirect?
     *
     * @return bool
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * Get the required redirect method (either GET or POST).
     *
     * @return string
     */
    public function getRedirectMethod()
    {
        return 'POST';
    }

    public function getRedirectUrl()
    {
        return $this->request->getTestMode() ?
            "https://sandbox-api.payuni.com.tw/api/upp" :
            "https://api.payuni.com.tw/api/upp";
    }

    public function getRedirectData()
    {
        return $this->getData();
    }
}
