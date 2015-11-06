<?php
namespace Billers\PayON\BankTransfer\BankAccount;
use Billers\PayON\BankTransfer\Exceptions\IncorrectFormatException;
use Billers\PayON\CreditCard\Data\IArrayable;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer\BankAccount
 */
class Mandate implements IArrayable
{

	/**
	 * @var string AN256[a-zA-Z]{0,256}
	 */
	private $id;
	/**
	 * @var \DateTime
	 */
	private $dateOfSignature;

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 * @return Mandate
	 * @throws IncorrectFormatException
	 */
	public function setId($id)
	{
		if(!preg_match("/^[a-zA-Z]{0,256}$/", $id)){
			throw new IncorrectFormatException();
		}
		$this->id = $id;
		return $this;
	}

	/**
	 * @return \DateTime
	 */
	public function getDateOfSignature()
	{
		return $this->dateOfSignature;
	}

	/**
	 * @param \DateTime $dateOfSignature
	 * @return Mandate
	 */
	public function setDateOfSignature($dateOfSignature)
	{
		$this->dateOfSignature = $dateOfSignature;
		return $this;
	}

	public function toArray($iterator = null)
	{

	}


}