<?php

require __DIR__ . '/../../bootstrap.php';
\Tracy\Debugger::enable();
class PayONBillerBankTransferTest extends \Tester\TestCase
{
	/** @var  \Billers\PayON\BankTransfer\PayONBiller */
	protected $bankBiller;

	public function setUp()
	{
		$this->bankBiller = new \Billers\PayON\BankTransfer\PayONBiller();
	}

	public function testPayment()
	{
		$transferDetails = new \Billers\PayON\BankTransfer\TransferDetails();
		$bankAccount = new \Billers\PayON\BankTransfer\BankAccount();

		$bankAccount
			->setBic('MARKDEF1100')
			->setIban('DE23100000001234567890')
			->setCountry("DE")
			->setHolder('Jane Jones');

		$transferDetails
			->setCurrency("EUR")
			->setPaymentBrand('DIRECTDEBIT_SEPA')
			->setPaymentType('DB')
			->setBankAccount($bankAccount);

		\Tester\Assert::true($this->bankBiller->createBankTransferPayment(10.20, $transferDetails)->process());
	}

	public function testPaymentWithCustomParameters(){
		$transferDetails = new \Billers\PayON\BankTransfer\TransferDetails();
		$customer = new \Billers\PayON\BankTransfer\Customer();
		$billing = new \Billers\PayON\BankTransfer\Billing();

		$customer->setGivenName("Jane")
			->setSurname("Jones")
			->setEmail("test@test.com")
			->setIp("123.123.123.123");

		$billing->setStreet1("123 Street")
			->setCountry("DE")
			->setCity("Munich")
			->setCountry("DE")
			->setPostcode("A1 2BC");

		$transferDetails
			->setCurrency("EUR")
			->setPaymentBrand("PAYOLUTION_ELV")
			->setPaymentType("DB")
			->setCustomer($customer)
			->setBilling($billing)
			->setCustomParameters([
				new \Billers\PayON\BankTransfer\CustomParameter("PAYOLUTION_ITEM_PRICE_1", "2.00"),
				new \Billers\PayON\BankTransfer\CustomParameter("PAYOLUTION_ITEM_DESCR_1", "Test item #1"),
				new \Billers\PayON\BankTransfer\CustomParameter("PAYOLUTION_ITEM_PRICE_2", "3.00"),
				new \Billers\PayON\BankTransfer\CustomParameter("PAYOLUTION_ITEM_DESCR_2", "Test item #2")
			])
			->setShopperResultUrl("http://nobrain.dk")
			->setTestMode("EXTERNAL");

		\Tester\Assert::true($this->bankBiller->createBankTransferPayment(10.20, $transferDetails)->process());
	}
}

$testCase2 = new PayONBillerBankTransferTest();
$testCase2->run();