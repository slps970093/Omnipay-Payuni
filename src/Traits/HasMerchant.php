<?php

namespace Omnipay\Payuni\Traits;

trait HasMerchant
{
    /**
     * 商店 Hash Key
     * @return void
     */
    public function setHashKey($marKey)
    {
        $this->setParameter('HashKey', $marKey);
    }

    /**
     * 商店 Hash IV
     * @return void
     */
    public function setHashIV($marIv)
    {
        $this->setParameter('HashIV', $marIv);
    }

    /**
     * 商店代號
     * @return void
     */
    public function setMerID($merId)
    {
        $this->setParameter('MerID', $merId);
    }

    /**
     * 商店訂單編號
     * @return void
     */
    public function setMerTradeNo($merTradeNo)
    {
        $this->setParameter('MerTradeNo', $merTradeNo);
    }

}
