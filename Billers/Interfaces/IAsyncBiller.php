<?php
namespace CzechCash\Billers\Interfaces;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Interfaces
 */
interface IAsyncBiller
{
	public function createCheckout($amount, $currency);
	public function checkPaymentStatus();
}