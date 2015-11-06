<?php
namespace Billers\PayON\CreditCard\Data;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard
 */
abstract class Data implements IData
{
	/**
	 * @var string
	 */
	private $userId;
	/**
	 * @var string
	 */
	private $password;
	/**
	 * @var string
	 */
	private $entityId;
	/**
	 * @var float
	 */
	private $amount;
	/**
	 * @var string
	 */
	private $currency;
	/**
	 * @var string
	 */
	private $paymentBrand;
	/**
	 * @var string
	 */
	private $paymentType;

	/**
	 * @return string
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @param string $userId
	 * @return Data
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return Data
	 */
	public function setPassword($password)
	{
		$this->password = $password;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEntityId()
	{
		return $this->entityId;
	}

	/**
	 * @param string $entityId
	 * @return Data
	 */
	public function setEntityId($entityId)
	{
		$this->entityId = $entityId;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * @param float $amount
	 * @return Data
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->currency;
	}

	/**
	 * @param string $currency
	 * @return Data
	 */
	public function setCurrency($currency)
	{
		$this->currency = $currency;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentBrand()
	{
		return $this->paymentBrand;
	}

	/**
	 * @param string $paymentBrand
	 * @return Data
	 */
	public abstract function setPaymentBrand($paymentBrand);

	protected function setPaymentBrandForce($paymentBrand)
	{
		$this->paymentBrand = $paymentBrand;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPaymentType()
	{
		return $this->paymentType;
	}

	/**
	 * @param string $paymentType
	 * @return Data
	 */
	public function setPaymentType($paymentType)
	{
		$this->paymentType = $paymentType;
		return $this;
	}

	public function invokeGetter($propertyName)
	{
		$getterName = ['get' . ucfirst($propertyName), 'is' . ucfirst($propertyName)];
		$value = null;
		foreach ($getterName as $getter) {
			if (method_exists($this, $getter)) {
				$value = Callback::invoke([$this, $getter]);
				break;
			}
		}
		return $value;
	}


}