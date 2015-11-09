<?php
namespace Billers\PayON\Data;
use Billers\PayON\Data\Customer\BrowserFingerprint;
use Billers\PayON\Data\Exceptions\IncorrectFormatException;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class Customer
{
	/**
	 * @var string AN255[\s\S]{1,255}
	 */
	private $merchantCustomerId;
	/**
	 * @var string AN50[\s\S]{2,50}
	 */
	private $givenName;
	/**
	 * @var string AN50[\s\S]{2,50}
	 */
	private $surname;
	/**
	 * @var string A1 M|F
	 */
	private $sex;
	/**
	 * @var \DateTime
	 */
	private $birthDate;
	/**
	 * @var string AN25[a-zA-Z0-9\+-.]{6, 25}
	 */
	private $phone;
	/**
	 * @var string AN25[a-zA-Z0-9\+-.]{10, 25}
	 */
	private $mobile;
	/**
	 * @var string AN128[\s\S]{6,128}
	 */
	private $email;
	/**
	 * @var string AN40[\s\S]{1,40}
	 */
	private $companyName;
	/**
	 * @var string A12[\s\S]
	 */
	private $identificationDocType;
	/**
	 * @var string AN64[\s\S]{8,64}
	 */
	private $identificationDocId;
	/**
	 * @var string AN255[\s\S]{1,255}
	 */
	private $ip;
	/**
	 * @var BrowserFingerprint
	 */
	private $browserFingerprint;

	/**
	 * @return string
	 */
	public function getMerchantCustomerId()
	{
		return $this->merchantCustomerId;
	}

	/**
	 * @param string $merchantCustomerId
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setMerchantCustomerId($merchantCustomerId)
	{
		if(!preg_match('/^.{1,255}$/', $merchantCustomerId)){
			throw new IncorrectFormatException;
		}
		$this->merchantCustomerId = $merchantCustomerId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGivenName()
	{
		return $this->givenName;
	}

	/**
	 * @param string $givenName
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setGivenName($givenName)
	{
		if(!preg_match('/^.{2,50}$/', $givenName)){
			throw new IncorrectFormatException;
		}
		$this->givenName = $givenName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSurname()
	{
		return $this->surname;
	}

	/**
	 * @param string $surname
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setSurname($surname)
	{
		if(!preg_match('/^.{2,50}$/', $surname)){
			throw new IncorrectFormatException;
		}
		$this->surname = $surname;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getSex()
	{
		return $this->sex;
	}

	/**
	 * @param string $sex
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setSex($sex)
	{
		$sex = strtoupper($sex);
		if($sex !== "M" || $sex !== "F"){
			throw new IncorrectFormatException;
		}
		$this->sex = $sex;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getBirthDate()
	{
		return $this->birthDate;
	}

	/**
	 * @param \DateTime $birthDate
	 * @return Customer
	 */
	public function setBirthDate($birthDate)
	{
		$this->birthDate = $birthDate;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param string $phone
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setPhone($phone)
	{
		if(!preg_match('/^[a-zA-Z0-9\+-.]{6, 25}$/', $phone)){
			throw new IncorrectFormatException;
		}
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMobile()
	{

		return $this->mobile;
	}

	/**
	 * @param string $mobile
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setMobile($mobile)
	{
		if(!preg_match('/^[a-zA-Z0-9\+-.]{10, 25}$/', $mobile)){
			throw new IncorrectFormatException;
		}
		$this->mobile = $mobile;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setEmail($email)
	{
		if(!preg_match('/^[\s\S]{6,128}$/', $email)){
			throw new IncorrectFormatException;
		}
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCompanyName()
	{
		return $this->companyName;
	}

	/**
	 * @param string $companyName
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setCompanyName($companyName)
	{
		if(!preg_match('/^[\s\S]{1,40}$/', $companyName)){
			throw new IncorrectFormatException;
		}
		$this->companyName = $companyName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdentificationDocType()
	{
		return $this->identificationDocType;
	}

	/**
	 * @param string $identificationDocType
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setIdentificationDocType($identificationDocType)
	{
		if(!preg_match('/^[\s\S]$/', $identificationDocType)){
			throw new IncorrectFormatException;
		}
		$this->identificationDocType = $identificationDocType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getIdentificationDocId()
	{
		return $this->identificationDocId;
	}

	/**
	 * @param string $identificationDocId
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setIdentificationDocId($identificationDocId)
	{
		if(!preg_match('/^[\s\S]{8,64}$/', $identificationDocId)){
			throw new IncorrectFormatException;
		}
		$this->identificationDocId = $identificationDocId;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getIp()
	{
		return $this->ip;
	}

	/**
	 * @param string $ip
	 * @return Customer
	 * @throws IncorrectFormatException
	 */
	public function setIp($ip)
	{
		if(!preg_match('/^[\s\S]{1,255}$/', $ip)){
			throw new IncorrectFormatException;
		}
		$this->ip = $ip;
		return $this;
	}

	/**
	 * @return BrowserFingerprint
	 */
	public function getBrowserFingerprint()
	{
		return $this->browserFingerprint;
	}

	/**
	 * @param BrowserFingerprint $browserFingerprint
	 * @return Customer
	 */
	public function setBrowserFingerprint($browserFingerprint)
	{
		$this->browserFingerprint = $browserFingerprint;
		return $this;
	}


}