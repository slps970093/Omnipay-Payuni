<?php

namespace Omnipay\Payuni\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;
use Omnipay\Payuni\Support\EncryptInfo;
use Omnipay\Payuni\Traits\HasMerchant;
use Omnipay\Payuni\Traits\HasPayUniApi;
use Omnipay\Payuni\Traits\HasProduct;

class PeriodPageRequest extends AbstractRequest
{
	use HasProduct, HasMerchant, HasPayUniApi;

	/**
	 * 每期金額
	 * @param $periodAmt
	 * @return void
	 */
	public function setPeriodAmt($periodAmt)
	{
		$this->setParameter('PeriodAmt', $periodAmt);
	}

	/**
	 * 付款人姓名
	 * @param $payerName
	 * @return void
	 */
	public function setPayerName($payerName)
	{
		$this->setParameter('PayerName', $payerName);
	}

	/**
	 * 付款人電話
	 * @param $payerPhone
	 * @return void
	 */
	public function setPayerPhone($payerPhone)
	{
		$this->setParameter('PayerPhone', $payerPhone);
	}

	/**
	 * 付款人Email
	 * @param $payerEmail
	 * @return void
	 */
	public function setPayerEmail($payerEmail)
	{
		$this->setParameter('PayerEmail', $payerEmail);
	}

	/**
	 * 啟用信用卡3D交易時需輸入持卡人英文名稱，供發卡行驗證
	 * @param $cardholder
	 * @return void
	 */
	public function setCardholder($cardholder)
	{
		$this->setParameter('Cardholder',$cardholder);
	}

	/**
	 * 續期支付頁付款人姓名、電話、Email 若無帶入PayerFix參數，則預設可修改
	 * @param $payerFix
	 * @return void
	 */
	public function setPayerFix($payerFix)
	{
		$this->setParameter('PayerFix', $payerFix);
	}

	/**
	 * 扣款週期
	 * @return void
	 */
	public function setPeriodType($periodType)
	{
		$this->setParameter('PeriodType', $periodType);
	}

	/**
	 * 扣款日期
	 * @param $periodDate
	 * @return void
	 */
	public function setPeriodDate($periodDate)
	{
		$this->setParameter('PeriodDate', $periodDate);
	}

	/**
	 * 扣款期數
	 * @param $periodTimes
	 * @return void
	 */
	public function setPeriodTimes($periodTimes)
	{
		$this->setParameter('PeriodTimes', $periodTimes);
	}

	/**
	 * 自訂扣款日期
	 * 1.提供商店在續期收款週期使用更有彈性；提供商店自訂扣款設定
	 * 2.商店自訂扣款日期與期數 YYYY-MM-DD 例如:商店扣款3期，帶入日期如下 2023-10-17,2023-10-30,2023-11-12
	 * @param $date
	 * @return void
	 */
	public function setDate($date)
	{
		$this->setParameter('Date', $date);
	}


	public function setFAmt($amt)
	{
		$this->setParameter('FAmt', $amt);
	}

	public function setFType($fType)
	{
		$this->setParameter('FType', $fType);
	}

	public function setFDate($fDate)
	{
		$this->setParameter('FDate', $fDate);
	}



	public function setAPI3D($api3D)
	{
		$this->setParameter('API3D', $api3D);
	}

	public function setBackURL($backUrl)
	{
		$this->setParameter('BackURL', $backUrl);
	}

	public function setTradeLExpireSec($tradeLExpireSec)
	{
		$this->setParameter('TradeLExpireSec', $tradeLExpireSec);
	}


	public function sendData($data)
	{
		$data['testMode'] = $this->getParameter('testMode');

		return new PeriodPageResponse($this, $data);
	}

	public function getData()
	{
		// TODO: Implement getData() method.
		$mergeData = [
			'PeriodAmt' => $this->getParameter('PeriodAmt'),
			'PayerName' => $this->getParameter('PayerName'),
			'PayerPhone' => $this->getParameter('PayerPhone'),
			'PayerEmail' => $this->getParameter('PayerEmail'),
			'Cardholder' => $this->getParameter('Cardholder'),
			'PayerFix' => $this->getParameter('PayerFix'),
			'PeriodType' => $this->getParameter('PeriodType'),
			'PeriodDate' => $this->getParameter('PeriodDate'),
			'PeriodTimes' => $this->getParameter('PeriodTimes'),
			'Date' => $this->getParameter('Date'),
			'FAmt' => $this->getParameter('FAmt'),
			'FType' => $this->getParameter('FType'),
			'FDate' => $this->getParameter('FDate'),
			'API3D' => $this->getParameter('API3D'),
			'TradeLExpireSec' => $this->getParameter('TradeLExpireSec'),
			'HashKey' => $this->getParameter("HashKey"),
            'HashIV' => $this->getParameter("HashIV"),
		];

		return array_merge(EncryptInfo::getBasicInfo($this->parameters), $mergeData);

	}
}
