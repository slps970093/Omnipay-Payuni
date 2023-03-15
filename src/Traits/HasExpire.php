<?php

namespace Omnipay\Payuni\Traits;

trait HasExpire
{
    /**
     * 繳費截止日期
     * @param $expireDate
     * @return void
     */
    public function setExpireDate($expireDate)
    {
        $this->setParameter('ExpireDate', $expireDate);
    }
}
