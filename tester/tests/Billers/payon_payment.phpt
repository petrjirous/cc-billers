<?php

require __DIR__ . '/../../bootstrap.php';
//\Tracy\Debugger::enable();
class PayONBillerTest extends \Tester\TestCase
{
	/** @var  \Billers\PayON\PayONBiller */
	protected $biller;

	public function setUp()
	{
		$this->biller = new \Billers\PayON\PayONBiller();
	}

	public function testBankTransferPayment()
	{
		$transferDetails = new \Billers\PayON\Data\TransferDetails();
		$bankAccount = new \Billers\PayON\Data\BankAccount\BankAccount();

		$bankAccount
			->setBic('MARKDEF1100')
			->setIban('DE23100000001234567890')
			->setCountry("DE")
			->setHolder('Jane Jones');

		$transferDetails
			->setCurrency("EUR")
			->setAmount(10)
			->setPaymentBrand('DIRECTDEBIT_SEPA')
			->setPaymentType('DB')
			->setBankAccount($bankAccount);

		\Tester\Assert::true($this->biller->createPayment($transferDetails)->process());
	}

	public function testCreditCardPayment(){
		$transferDetails = new \Billers\PayON\Data\TransferDetails();
		$expiry = new \CzechCash\Billers\Structures\CreditCards\CreditCardExpiry("05/18");
		$creditCard = new \CzechCash\Billers\Structures\CreditCards\CreditCard('377777777777770', $expiry, "1234", "Jane Jones");

		$transferDetails->setCard($creditCard)
			->setAmount(92.00)
			->setCurrency("EUR")
			->setPaymentBrand("AMEX")
			->setPaymentType("DB");

		Tester\Assert::true($this->biller->createPayment($transferDetails)->process());
	}

}

$testCase2 = new PayONBillerTest();
$testCase2->run();