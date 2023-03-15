<?php

namespace Omnipay\Payuni\Support;

use Illuminate\Support\Collection;
use Omnipay\Common\Message\AbstractRequest;
use Symfony\Component\HttpFoundation\ParameterBag;

class EncryptInfo
{
    public static function getBasicInfo(ParameterBag $parameter): Collection
    {
        return collect([
            # 加密資訊 這邊放基本共通一定會出現的
            "MerID"         		=> $parameter->get('MerID'),
            "MerTradeNo"    		=> $parameter->get('MerTradeNo'),
            "TradeAmt"      		=> $parameter->get('TradeAmt'),
            "Timestamp"     		=> $parameter->get('Timestamp'),
            "BackURL"       		=> $parameter->get('BackURL'),
            "ReturnURL"     		=> $parameter->get('returnUrl'),
            "NotifyURL"     		=> $parameter->get('notifyUrl'),
            "ProdDesc"				=> $parameter->get('ProdDesc'),
            "UsrMail"				=> $parameter->get('UsrMail'),
        ]);
    }

    public static function filterNull(Collection $collection): Collection
    {
        return $collection->filter(function ($item) {
            return !is_null($item);
        });
    }
}
