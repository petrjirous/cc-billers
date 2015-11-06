<?php
namespace Billers\PayON\CreditCard\Data;

use CzechCash\Billers\Structures\CreditCards\CreditCard;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard
 */
class Synchronous extends Data
{

	const BRANDS = [
		'WORLD',
		'VPAY',
		'VISAELECTRON',
		'VISA',
		'SERVIRED',
		'POSTEPAY',
		'MAXIMUM',
		'MASTER',
		'MAESTRO',
		'JCB',
		'HIPERCARD',
		'ELO',
		'DISCOVER',
		'DINERS',
		'DANKORT',
		'CARTEBLEUE',
		'CARTEBANCAIRE',
		'CARDFINANS',
		'CABAL',
		'BONUS',
		'AXESS',
		'ASYACARD',
		'AMEX',
		'KLARNA_INVOICE',
		'DIRECTDEBIT_SEPA'
	];

	const DIRECTDEBIT_SEPA = [
		'bankAccount_bic',
		'bankAccount_iban',
		'bankAccount_country',
		'bankAccount_holder'
	];

	const CREDIT_CARD = ['creditCard'];

	const KLARNA_INVOICE = [
		'billing_country',
		'billing_street1',
		'billing_city',
		'billing_postcode',
		'cart',
		'customer',
		'shopperResultUrl'
	];



	/**
	 * @var ICreditCard
	 */
	private $creditCard;

	/**
	 * @return ICreditCard
	 */
	public function getCreditCard()
	{
		return $this->creditCard;
	}

	/**
	 * @param ICreditCard $creditCard
	 * @return Synchronous
	 */
	public function setCreditCard($creditCard)
	{
		$this->creditCard = $creditCard;
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


	public function getInRequestFormat()
	{
//		$data = [
//			"authentication.userId=" . $this->getUserId(),
//			"authentication.password=" . $this->getPassword(),
//			"authentication.entityId=" . $this->getEntityId(),
//			"amount=" . $this->getAmount(),
//			"currency=" . $this->getCurrency(),
//			"paymentBrand=" . $this->getPaymentBrand(),
//			"paymentType=" . $this->getPaymentType(),
//			"card.number=" . $this->getCreditCard()->getCardNumber(),
//			"card.holder=" . $this->getCreditCard()->getCardHolder(),
//			"card.expiryMonth=" . $this->getCreditCard()->getExpiration()->getMonth(),
//			"card.expiryYear=" . $this->getCreditCard()->getExpiration()->getYear("Y"),
//			"card.cvv=" . $this->getCreditCard()->getCvv()
//		];

		$data = [
			"authentication.userId" => $this->getUserId(),
			"authentication.password" => $this->getPassword(),
			"authentication.entityId" => $this->getEntityId(),
			"amount" => $this->getAmount(),
			"currency" => $this->getCurrency(),
			"paymentBrand" => $this->getPaymentBrand(),
			"paymentType" => $this->getPaymentType(),
		];

		if($this->getPaymentBrand() === 'DIRECTDEBIT_SEPA'){
			foreach(self::DIRECTDEBIT_SEPA as $property){
				$data[str_replace('_', '.', $property)] = $this->invokeGetter($property);
			}
		}elseif($this->getPaymentBrand() === 'KLARNA_INVOICE'){
			foreach(self::KLARNA_INVOICE as $property){
				$data[str_replace('_', '.', $property)] = $this->invokeGetter($property);
			}
		}else{
			$data["card.number"] = $this->getCreditCard()->getCardNumber();
			$data["card.holder"] = $this->getCreditCard()->getCardHolder();
			$data["card.expiryMonth"] = $this->getCreditCard()->getExpiration()->getMonth();
			$data["card.expiryYear"] = $this->getCreditCard()->getExpiration()->getYear("Y");
			$data["card.cvv"] = $this->getCreditCard()->getCvv();
		}

		return $data;
	}

	public function set($amount, ICreditCard $card, array $details){
//		$this->setUserId($details['userId']);
//		$this->setPassword($details['password']);
//		$this->setEntityId($details['entityId']);
		$this->setAmount($amount);
		$this->setCurrency($details['currency']);
		$this->setPaymentBrand($details['paymentBrand']);
		$this->setPaymentType($details['paymentType']);
		$this->setCreditCard($card);
	}

	public static function fromArray(array $array)
	{
		return new Synchronous(
			$array['userId'],
			$array['password'],
			$array['entityId'],
			$array['amount'],
			$array['currency'],
			$array['paymentBrand'],
			$array['paymentType'],
			new CreditCard(
				$array['creditCardNumber'],
				$array['creditCardExpiration'],
				$array['creditCardCvv'],
				$array['creditCardHolder']));
	}
}