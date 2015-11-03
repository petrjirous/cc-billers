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
			"card.number" => $this->getCreditCard()->getCardNumber(),
			"card.holder" => $this->getCreditCard()->getCardHolder(),
			"card.expiryMonth" => $this->getCreditCard()->getExpiration()->getMonth(),
			"card.expiryYear" => $this->getCreditCard()->getExpiration()->getYear("Y"),
			"card.cvv" => $this->getCreditCard()->getCvv()
		];

		//return join('&', $data);
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