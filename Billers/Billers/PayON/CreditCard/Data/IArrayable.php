<?php
namespace Billers\PayON\CreditCard\Data;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON\CreditCard\Data
 */
interface IArrayable
{
	public function toArray($iterator = null);
}