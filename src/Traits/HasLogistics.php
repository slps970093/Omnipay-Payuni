<?php

namespace Omnipay\Payuni\Traits;

trait HasLogistics
{
    /**
     * 取貨不付款
     * @param $type
     * @return void
     */
    public function setServiceType($type)
    {
        $this->setParameter('ServiceType', $type);
    }

    /**
     * 門市代碼
     * @param $id
     * @return void
     */
    public function setStoreID($id)
    {
        $this->setParameter('StoreID', $id);
    }

    /**
     * 取件人姓名
     * @param $consignee
     * @return void
     */
    public function setConsignee($consignee)
    {
        $this->setParameter('Consignee', $consignee);
    }

    /**
     * 取件人手機號碼
     * @param $consigneeMobile
     * @return void
     */
    public function setConsigneeMobile($consigneeMobile)
    {
        $this->setParameter('ConsigneeMobile', $consigneeMobile);
    }

    /**
     * 物流型態
     * @param $type
     * @return void
     */
    public function setLgsType($type)
    {
        $this->setParameter('LgsType', $type);
    }

    /**
     * 寄件型態
     * @param $type
     * @return void
     */
    public function setGoodsType($type)
    {
        $this->setParameter('GoodsType', $type);
    }

    /**
     * 通路類別
     * @param $type
     * @return void
     */
    public function setShipType($type)
    {
        $this->setParameter('ShipType', $type);
    }
}
