<?php
namespace Billers\PayON\CreditCard\Data;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard
 */
interface IData
{
	/**
	 * Get data in request format
	 * @return string
	 */
	public function getInRequestFormat();
}

class DataTypeMismatchException extends \Exception
{

}