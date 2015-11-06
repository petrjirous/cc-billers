<?php
namespace Billers\PayON\BankTransfer;
use Billers\PayON\BankTransfer\BankAccount\Mandate;
use Billers\PayON\BankTransfer\Exceptions\IncorrectFormatException;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class BankAccount
{
	const DateTimeFormat = 'Y-m-d';
	/**
	 * @var string AN128{4,128}
	 */
	private $holder;
	/**
	 * @var string AN255[\s\S]{1,255}
	 */
	private $bankName;
	/**
	 * @var string AN64[a-zA-Z0-9}{3,64}
	 */
	private $number;
	/**
	 * @var string AN31[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{11,27}
	 */
	private $iban;
	/**
	 * @var string AN12[a-zA-Z0-9]{1,12}
	 */
	private $bankCode;
	/**
	 * @var string AN11[a-zA-Z0-9]{8}|[a-zA-Z0-9]{11}
	 */
	private $bic;
	/**
	 * @var string AN2[a-zA-Z]{2}
	 */
	private $country;
	/**
	 * @var Mandate
	 */
	private $mandate;
	/**
	 * @var \DateTime
	 */
	private $transactionDueDate;

	/**
	 * @return string
	 */
	public function getHolder()
	{
		return $this->holder;
	}

	/**
	 * @param string $holder
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setHolder($holder)
	{
		if(!preg_match('/^.{4,128}$/', $holder)){
			throw new IncorrectFormatException;
		}
		$this->holder = $holder;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankName()
	{
		return $this->bankName;
	}


	/**
	 * @param $bankName
	 * @return $this
	 * @throws IncorrectFormatException
	 */
	public function setBankName($bankName)
	{
		if(!preg_match('/^.{1,255}$/', $bankName)){
			throw new IncorrectFormatException();
		}
		$this->bankName = $bankName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getNumber()
	{
		return $this->number;
	}

	/**
	 * @param string $number
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setNumber($number)
	{
		if(!preg_match('/^[a-zA-Z0-9}{3,64}$/', $number)){
			throw new IncorrectFormatException;
		}
		$this->number = $number;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getIban()
	{
		return $this->iban;
	}

	/**
	 * @param string $iban
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setIban($iban)
	{
		if(!preg_match('/^[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{11,27}$/', $iban)){
			throw new IncorrectFormatException;
		}
		$this->iban = $iban;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBankCode()
	{
		return $this->bankCode;
	}

	/**
	 * @param string $bankCode
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setBankCode($bankCode)
	{
		if(!preg_match('/^[a-zA-Z0-9]{1,12}$/', $bankCode)){
			throw new IncorrectFormatException;
		}
		$this->bankCode = $bankCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getBic()
	{
		return $this->bic;
	}

	/**
	 * @param string $bic
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setBic($bic)
	{
		if(!preg_match('/^[a-zA-Z0-9]{8}|[a-zA-Z0-9]{11}$/', $bic)){
			throw new IncorrectFormatException;
		}
		$this->bic = $bic;
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
	 * @return BankAccount
	 * @throws IncorrectFormatException
	 */
	public function setCountry($country)
	{
		if(!preg_match('/^[a-zA-Z]{2}$/', $country)){
			throw new IncorrectFormatException;
		}
		$this->country = $country;
		return $this;
	}

	/**
	 * @return Mandate
	 */
	public function getMandate()
	{
		return $this->mandate;
	}

	/**
	 * @param Mandate $mandate
	 * @return BankAccount
	 */
	public function setMandate($mandate)
	{
		$this->mandate = $mandate;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getTransactionDueDate()
	{
		return $this->transactionDueDate;
	}

	/**
	 * @param \DateTime $transactionDueDate
	 * @return BankAccount
	 */
	public function setTransactionDueDate($transactionDueDate)
	{
		$this->transactionDueDate = $transactionDueDate;
		return $this;
	}




}