<?php
namespace Billers\PayON\BankTransfer;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\BankTransfer
 */
class CustomParameter
{
	/**
	 * @var string
	 */
	private $name;
	private $value;

	/**
	 * CustomParameter constructor.
	 * @param string $name
	 * @param $value
	 */
	public function __construct($name, $value)
	{
		$this->name = $name;
		$this->value = $value;
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return CustomParameter
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getValue()
	{
		return $this->value;
	}

	/**
	 * @param mixed $value
	 * @return CustomParameter
	 */
	public function setValue($value)
	{
		$this->value = $value;
		return $this;
	}

}