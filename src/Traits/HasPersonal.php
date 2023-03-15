<?php

namespace Omnipay\Payuni\Traits;

trait HasPersonal
{
    public function setUsrMail($mail)
    {
        $this->setParameter('UsrMail', $mail);
    }

    public function setUsrMailFix($mailFix)
    {
        $this->setParameter('UsrMailFix', $mailFix);
    }
}
