<?php

namespace Omnipay\Payuni\Traits;

trait HasEncrypt
{
    protected function encrypt(array $data = [], string $merKey = "", string $merIV = ""): string
    {
        $tag = ""; //預設為空
        $encrypted = openssl_encrypt(http_build_query($data), "aes-256-gcm", trim($merKey), 0, trim($merIV), $tag);
        return trim(bin2hex($encrypted . ":::" . base64_encode($tag)));
    }

    public function decrypt(string $encryptStr = "", string $merKey = "", string $merIV = "")
    {
        list($encryptData, $tag) = explode(":::", hex2bin($encryptStr), 2);
        return openssl_decrypt($encryptData, "aes-256-gcm", trim($merKey), 0, trim($merIV), base64_decode($tag, true));
    }

    protected function hashInfo($encryptStr, string $merKey = "", string $merIV = "")
    {
        return strtoupper(hash('sha256', $merKey.$encryptStr.$merIV));
    }
}
