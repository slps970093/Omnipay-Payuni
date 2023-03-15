<?php

namespace Omnipay\Payuni\Traits;

trait HasProduct
{
    /**
     * 商品說明
     * @param $prodDesc
     * @return void
     */
    public function setProdDesc($prodDesc)
    {
        $this->setParameter('ProdDesc', $prodDesc);
    }
}
