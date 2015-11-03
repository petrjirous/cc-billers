<?php
namespace Billers\PayON\CreditCard\Data;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard
 */
class Asynchronous extends Data
{

	const BRANDS = [
		'YANDEX',
		'UKASH',
		'TRUSTLY',
		'TENPAY',
		'PRZELEWY',
		'PF_KARTE_DIRECT',
		'PAYTRAIL',
		'PAYSAFECARD',
		'PAYPAL',
		'PAYOLUTION_INVOICE',
		'PAYOLUTION_INS',
		'PAYOLUTION_ELV',
		'PAYBOX',
		'ONECARD',
		'MONEYBOOKERS',
		'KLARNA_INSTALLMENTS',
		'IPARA',
		'DAOPAY',
		'CHINAUNIONPAY',
		'ALIPAY',
		'TRUSTPAY_VA',
		'SOFORTUEBERWEISUNG',
		'PREPAYMENT',
		'POLI',
		'INTERAC_ONLINE',
		'IDEAL',
		'GIROPAY',
		'EPS',
		'BOLETO',
		'ALLPAGO_INVOICE'
	];

	/**
	 * @var string
	 */
	private $shopperResultUrl;

	/**
	 * @return string
	 */
	public function getShopperResultUrl()
	{
		return $this->shopperResultUrl;
	}

	/**
	 * @param string $shopperResultUrl
	 * @return Asynchronous
	 */
	public function setShopperResultUrl($shopperResultUrl)
	{
		$this->shopperResultUrl = $shopperResultUrl;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function setPaymentBrand($paymentBrand)
	{
		$brand = strtoupper($paymentBrand);
		if(!in_array($brand, self::BRANDS)){
			throw new DataTypeMismatchException();
		}
		$this->setPaymentBrandForce($brand);
	}


	/**
	 * @inheritDoc
	 */
	public function getInRequestFormat()
	{
		$data = [
			"authentication.userId=" . $this->getUserId(),
			"authentication.password=" . $this->getPassword(),
			"authentication.entityId=" . $this->getEntityId(),
			"amount=" . $this->getAmount(),
			"currency=" . $this->getCurrency(),
			"paymentBrand=" . $this->getPaymentBrand(),
			"paymentType=" . $this->getPaymentType(),
			"shopperResultUrl=".$this->getShopperResultUrl()
		];

		return join('&', $data);
	}

	public function set($amount, $details){
//		$this->setUserId($details['userId']);
//		$this->setPassword($details['password']);
//		$this->setEntityId($details['entityId']);
		$this->setAmount($amount);
		$this->setCurrency($details['currency']);
		$this->setPaymentBrand($details['paymentBrand']);
		$this->setPaymentType($details['paymentType']);
		$this->setShopperResultUrl($details['shopperResultUrl']);
	}


}