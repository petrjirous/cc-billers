<?php
namespace Billers\PayON\BankTransfer;
use Billers\PayON\BankTransfer\Exceptions\IncorrectFormatException;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class Billing
{
	/**
	 * @var string AN50[\s\S]{2,50}
	 */
	private $street1;
	/**
	 * @var string AN50[\s\S]{2,50}
	 */
	private $street2;
	/**
	 * @var string AN30[\s\S]{2,30}
	 */
	private $city;
	/**
	 * @var string AN50[a-zA-Z0-9\.]{2,50}
	 */
	private $state;
	/**
	 * @var string AN10[A-Za-z0-9]{1,10}
	 */
	private $postcode;
	/**
	 * @var string A2[A-Za-z]{2}
	 */
	private $country;

	/**
	 * @return string
	 */
	public function getStreet1()
	{
		return $this->street1;
	}

	/**
	 * @param string $street1
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setStreet1($street1)
	{
		if(!preg_match('/^[\s\S]{2,50}$/', $street1)){
			throw new IncorrectFormatException;
		}
		$this->street1 = $street1;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStreet2()
	{
		return $this->street2;
	}

	/**
	 * @param string $street2
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setStreet2($street2)
	{
		if(!preg_match('/^[\s\S]{2,50}$/', $street2)){
			throw new IncorrectFormatException;
		}
		$this->street2 = $street2;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param string $city
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setCity($city)
	{
		if(!preg_match('/^[\s\S]{2,30}$/', $city)){
			throw new IncorrectFormatException;
		}
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getState()
	{
		return $this->state;
	}

	/**
	 * @param string $state
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setState($state)
	{
		if(!preg_match('/^[a-zA-Z0-9\.]{2,50}$/', $state)){
			throw new IncorrectFormatException;
		}
		$this->state = $state;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPostcode()
	{
		return $this->postcode;
	}

	/**
	 * @param string $postcode
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setPostcode($postcode)
	{
		if(!preg_match('/^[A-Za-z0-9 ]{1,10}$/', $postcode)){
			throw new IncorrectFormatException;
		}
		$this->postcode = $postcode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountry()
	{
		return $this->country;
	}

	/**
	 * @param string $country
	 * @return Billing
	 * @throws IncorrectFormatException
	 */
	public function setCountry($country)
	{
		if(!preg_match('/^[A-Za-z]{2}$/', $country)){
			throw new IncorrectFormatException;
		}
		$this->country = $country;
		return $this;
	}


}