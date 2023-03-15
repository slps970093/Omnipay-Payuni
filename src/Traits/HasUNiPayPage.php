<?php

namespace Omnipay\Payuni\Traits;

trait HasUNiPayPage
{
    /**
     * 信用卡一次付清
     * @param $credit
     * @return void
     */
    public function setCredit($credit)
    {
        $this->setParameter('Credit', $credit);
    }

    /**
     * icash Pay支付
     * @param $state
     * @return void
     */
    public function setICash($state)
    {
        $this->setParameter('ICash', $state);
    }

    /**
     * AFTEE先享後付
     * @param $state
     * @return void
     */
    public function setAftee($state)
    {
        $this->setParameter('Aftee', $state);
    }

    /**
     * 虛擬帳號支付
     * @param $state
     * @return void
     */
    public function setATM($state)
    {
        $this->setParameter('ATM', $state);
    }

    /**
     * 超商代碼/條碼支付
     * @param $state
     * @return void
     */
    public function setCVS($state)
    {
        $this->setParameter('CVS', $state);
    }

    /**
     * 信用卡(銀聯)支付
     * @param $state
     * @return void
     */
    public function setCreditUnionPay($state)
    {
        $this->setParameter('CreditUnionPay', $state);
    }

    /**
     * 信用卡(紅利)支付
     * @param $state
     * @return void
     */
    public function setCreditRed($state)
    {
        $this->setParameter('CreditRed', $state);
    }

    /**
     * 信用卡分期支付
     * @param $state
     * @return void
     */
    public function setCreditInst($state)
    {
        $this->setParameter('CreditInst', $state);
    }

    /**
     * Apple Pay
     * @param $state
     * @return void
     */
    public function setApplePay($state)
    {
        $this->setParameter('ApplePay', $state);
    }

    /**
     * 貨到付款
     * @param $state
     * @return void
     */
    public function setShip($state)
    {
        $this->setParameter('Ship', $state);
    }

    /**
     * 純取貨付款
     * @param $state
     * @return void
     */
    public function setShipTag($state)
    {
        $this->setParameter('ShipTag', $state);
    }
}
