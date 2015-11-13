<?php
namespace Billers\Webbilling;


/**
 *
 *
 * @author Kenny
 * @package Billers\Webbilling
 */
class TransferDetails
{
	/**
	 * @var string
	 */
	private $bankAccountNumber;
	/**
	 * @var string
	 */
	private $bankRoutingNumber;
	/**
	 * @var string
	 */
	private $bankAccountOwner;
	/**
	 * @var string
	 */
	private $countryID;

	private $IBAN;

	private $BIC;

	private $bankName;
	private $city;

	/**
	 * @return string
	 */
	public function getBankAccountNumber()
	{
		return $this->bankAccountNumber;
	}

	/**
	 * @param string $bankAccountNumber
	 * @return TransferDetails
	 */
	public function setBankAccountNumber($bankAccountNumber)
	{
		$this->bankAccountNumber = $bankAccountNumber;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankRoutingNumber()
	{
		return $this->bankRoutingNumber;
	}

	/**
	 * @param string $bankRoutingNumber
	 * @return TransferDetails
	 */
	public function setBankRoutingNumber($bankRoutingNumber)
	{
		$this->bankRoutingNumber = $bankRoutingNumber;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankAccountOwner()
	{
		return $this->bankAccountOwner;
	}

	/**
	 * @param string $bankAccountOwner
	 * @return TransferDetails
	 */
	public function setBankAccountOwner($bankAccountOwner)
	{
		$this->bankAccountOwner = $bankAccountOwner;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCountryID()
	{
		return $this->countryID;
	}

	/**
	 * @param string $countryID
	 * @return TransferDetails
	 */
	public function setCountryID($countryID)
	{
		$this->countryID = $countryID;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getIBAN()
	{
		return $this->IBAN;
	}

	/**
	 * @param mixed $IBAN
	 * @return TransferDetails
	 */
	public function setIBAN($IBAN)
	{
		$this->IBAN = $IBAN;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getBIC()
	{
		return $this->BIC;
	}

	/**
	 * @param mixed $BIC
	 * @return TransferDetails
	 */
	public function setBIC($BIC)
	{
		$this->BIC = $BIC;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getBankName()
	{
		return $this->bankName;
	}

	/**
	 * @param mixed $bankName
	 * @return TransferDetails
	 */
	public function setBankName($bankName)
	{
		$this->bankName = $bankName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param mixed $city
	 * @return TransferDetails
	 */
	public function setCity($city)
	{
		$this->city = $city;
		return $this;
	}


}