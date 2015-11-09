<?php
namespace Billers\Epoch;
use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\ICreditCardBiller;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use CzechCash\Billers\Structures\Payments\ICreditCardPayment;


/**
 *
 *
 * @author Kenny
 * @package Billers\Epoch
 */
class EpochBiller extends BaseBiller implements ICreditCardBiller
{
	protected $configFile = __DIR__ . '/../config/epoch.neon';
	/**
	 * @inheritDoc
	 */
	public function isServiceAvailable()
	{
		// TODO: Implement isServiceAvailable() method.
	}

	/**
	 * @inheritDoc
	 */
	public function createCreditCardPayment($amount, ICreditCard $card, $details)
	{
		// TODO: Implement createCreditCardPayment() method.
	}

	/**
	 * @inheritDoc
	 */
	public static function formatCreditCard(ICreditCard $card)
	{
		// TODO: Implement formatCreditCard() method.
	}

}