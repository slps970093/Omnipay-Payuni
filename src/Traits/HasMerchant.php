<?php

namespace Omnipay\Payuni\Traits;

trait HasMerchant
{
    /**
     * 商店 Hash Key
     * @param string $marKey
     * @return void
     */
    public function setHashKey(string $marKey)
    {
        $this->setParameter('HashKey', $marKey);
    }

    /**
     * 商店 Hash IV
     * @param string $marIv
     * @return void
     */
    public function setHashIV(string $marIv)
    {
        $this->setParameter('HashIV', $marIv);
    }

    /**
     * 商店代號
     * @param string $merId
     * @return void
     */
    public function setMerID(string $merId)
    {
        $this->setParameter('MerID', $merId);
    }

    /**
     * 商店訂單編號
     * @param string $merTradeNo
     * @return void
     */
    public function setMerTradeNo(string $merTradeNo)
    {
        $this->setParameter('MerTradeNo', $merTradeNo);
    }

}
