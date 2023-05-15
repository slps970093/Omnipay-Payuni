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
}
