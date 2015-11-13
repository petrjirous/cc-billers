<?php
namespace CzechCash\Billers\Structures\Payments;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Structures\Payments
 */
class Payment extends BasePayment
{
	/**
	 * @inheritDoc
	 */
	public function validate($response)
	{
		return Callback::invoke($this->validate, $response);
	}

	public function process()
	{
		$this->checkHandlers();

		//$response = Callback::invoke($this->onProcess, )
	}

}