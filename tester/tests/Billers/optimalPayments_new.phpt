<?php
require __DIR__ . '/../../bootstrap.php';
\Tracy\Debugger::enable();
\Tracy\Debugger::$maxDepth = 500;
class OptimalPaymentsTest extends \Tester\TestCase{
	/** @var  \Billers\OptimalPayments\OptimalPaymentsBiller */
	protected $biller;
	public function setUp()
	{
		$this->biller = new \Billers\OptimalPayments\OptimalPaymentsBiller();
	}
	public function testPayment(){
		//$this->biller->createCheckout(1, 'USD');
	}
	public function testStatus(){
		\Tracy\Debugger::barDump($this->biller->checkPaymentStatus());
	}
}

$test = new OptimalPaymentsTest();
$test->run();