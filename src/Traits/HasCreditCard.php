<?php

namespace Omnipay\Payuni\Traits;

trait HasCreditCard
{
    public function setCardNo($cardNo)
    {
        $this->setParameter('CardNo', $cardNo);
    }

    public function setCardCVC($cardCVC)
    {
        $this->setParameter('CardCVC', $cardCVC);
    }

    public function setCardInst($cardInst)
    {
        $this->setParameter('CardInst', $cardInst);
    }

    public function setCardType($cardType)
    {
        $this->setParameter('CardType', $cardType);
    }

    /**
     * 信用卡Token 類型
     * @param $useTokenType
     * @return void
     */
    public function setUseTokenType($useTokenType)
    {
        $this->setParameter('UseTokenType', $useTokenType);
    }


    /**
     * 首次啟用信用卡Token交易(3D)
     * @param $useTokenStatus
     * @return void
     */
    public function setUseTokenStatus($useTokenStatus)
    {
        $this->setParameter('UseTokenStatus', $useTokenStatus);
    }

    /**
     * 信用卡有效日期
     * @param $cardExpired
     * @return void
     */
    public function setCardExpired($cardExpired)
    {
        $this->setParameter('CardExpired', $cardExpired);
    }

    /**
     * 信用卡(記憶卡號) 顯示類型 若無帶此參數則預設為2
     * @param $creditShowType
     * @return void
     */
    public function setCreditShowType($creditShowType)
    {
        $this->setParameter('CreditShowType', $creditShowType);
    }

    /**
     * 信用卡Token
     * @param $token
     * @return void
     */
    public function setCreditToken($token)
    {
        $this->setParameter('CreditToken', $token);
    }

    /**
     * 信用卡 Token 紀錄類型
     * @param $tokenType
     * @return void
     */
    public function setCreditTokenType($tokenType)
    {
        $this->setParameter('CreditTokenType', $tokenType);
    }

    /**
     * 信用卡 Token 有效期間
     * @param $tokenType
     * @return void
     */
    public function setCreditTokenExpired($tokenExpired)
    {
        $this->setParameter('CreditTokenExpired', $tokenExpired);
    }

    /**
     * 信用卡 Hash
     * @param $tokenType
     * @return void
     */
    public function setCreditHash($creditHash)
    {
        $this->setParameter('CreditHash', $creditHash);
    }

	/**
	 * 關帳類型
	 * @param $type
	 * @return void
	 */
	public function setCloseType($type)
	{
		$this->setParameter('CloseType', $type);
	}

    /**
     * 幕後強制3D
     * @param $api3D
     * @return void
     */
    public function setAPI3D($api3D)
    {
        $this->setParameter('API3D', $api3D);
    }
}
