<?php

namespace Omnipay\Payuni\Traits;

trait HasTrade
{
    /**
     * 訂單金額
     * @return void
     */
    public function setTradeAmt($tradeAmt)
    {
        $this->setParameter('TradeAmt', $tradeAmt);
    }

    /**
     * UNi序號
     * @param $tradeNo
     * @return void
     */
    public function setTradeNo($tradeNo)
    {
        $this->setParameter('TradeNo', $tradeNo);
    }

    /**
     * 時間戳記
     * @return void
     */
    public function setTimestamp($timestamp)
    {
        $this->setParameter('Timestamp', $timestamp);
    }

    /**
     * 付款頁面交易截止秒數 若未帶此參數則預設為600秒
     * @return void
     */
    public function setTradeLExpireSec($sec)
    {
        $this->setParameter('TradeLExpireSec', $sec);
    }

    /**
     * 編號類型
     * @param $type
     * @return void
     */
    public function setQueryType($type)
    {
        $this->setParameter('QueryType', $type);
    }

    /**
     * 編號
     *
     * 最多100筆 以逗號分隔 e.g. 1674006682603924996,1674006544051190875
     * @param $no
     * @return void
     */
    public function setQueryNo($no)
    {
        $this->setParameter('QueryNo', $no);
    }
}
