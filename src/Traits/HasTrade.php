<?php

namespace Omnipay\Payuni\Traits;

trait HasTrade
{
    /**
     * 訂單金額
     * @param int $tradeAmt
     * @return void
     */
    public function setTradeAmt(int $tradeAmt)
    {
        $this->setParameter('TradeAmt', $tradeAmt);
    }

    /**
     * 時間戳記
     * @param int $timestamp
     * @return void
     */
    public function setTimestamp(int $timestamp)
    {
        $this->setParameter('Timestamp', $timestamp);
    }

    /**
     * 付款頁面交易截止秒數 若未帶此參數則預設為600秒
     * @param int $sec
     * @return void
     */
    public function setTradeLExpireSec(int $sec)
    {
        $this->setParameter('TradeLExpireSec', $sec);
    }
}
