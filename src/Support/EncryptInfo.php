<?php

namespace Omnipay\Payuni\Support;

use Symfony\Component\HttpFoundation\ParameterBag;

class EncryptInfo
{
    public static function getBasicInfo(ParameterBag $parameter): array
    {
        return [
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
        ];
    }

    public static function filterNull(array $params): array
    {
        return array_filter($params, function ($value) {
            return !is_null($value);
        });
    }
}
