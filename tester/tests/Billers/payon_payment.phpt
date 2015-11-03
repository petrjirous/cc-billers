<?php
require __DIR__ . '/../../bootstrap.php';

class PayONBillerTest extends \Tester\TestCase
{
	/** @var  \Billers\PayON\CreditCard\PayONBiller */
	protected $biller;
	/** @var  \CzechCash\Billers\Structures\CreditCards\ICreditCard */
	protected $creditCard;

	public function setUp()
	{
		$this->biller = new \Billers\PayON\CreditCard\PayONBiller();
		$expiry = new \CzechCash\Billers\Structures\CreditCards\CreditCardExpiry('05/18');
		$this->creditCard = new \CzechCash\Billers\Structures\CreditCards\CreditCard('377777777777770', $expiry, 1234, 'Jane Jones');
	}

	public function testPayment()
	{
		$details = [
			'currency' => "EUR",
			'paymentBrand' => "AMEX",
			'paymentType' => "DB"
		];

		\Tester\Assert::true($this->biller->createCreditCardPayment(10, $this->creditCard, $details)->process());
	}
}

$testCase = new \PayONBillerTest();
$testCase->run();