<?php
namespace Billers\PayON;


/**
 *
 *
 * @author Kenny
 * @package Billers\PayON
 */
class BankTransferPaymentValidator
{
	public function __invoke($response)
	{
		/** @var \stdClass $data */
		$data = json_decode($response);
		return $data->result->code === "000.100.110"; // TODO test enviroment success code
	}
}