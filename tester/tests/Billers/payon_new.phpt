<?php
require __DIR__ . '/../../bootstrap.php';
\Tracy\Debugger::enable();
\Tracy\Debugger::$maxDepth = 500;

class PayONBillerTest2 extends Tester\TestCase{
	/** @var  \Billers\PayON\PayONBiller */
	protected $biller;

	public function setUp()
	{
		$this->biller = new \Billers\PayON\PayONBiller();
	}

	public function testPayment(){
		$this->biller->createCheckout(10, "USD");
	}

	public function testStatus(){
		\Tracy\Debugger::barDump($this->biller->checkPaymentStatus());
	}
}

$test = new PayONBillerTest2();
$test->run();