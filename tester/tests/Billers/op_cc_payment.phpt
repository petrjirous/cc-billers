<?php

require __DIR__ . '/../../bootstrap.php';

class OptimalPaymentsBillerTest extends \Tester\TestCase
{
    /** @var  \CzechCash\Billers\Billers\OptimalPayments\OptimalPaymentsBiller */
    protected $biller;

    /** @var  \CzechCash\Billers\Structures\CreditCards\ICreditCard */
    protected $creditCard;


    public function setUp()
    {
        $this->biller = new \CzechCash\Billers\Billers\OptimalPayments\OptimalPaymentsBiller();
        $expiry = new \CzechCash\Billers\Structures\CreditCards\CreditCardExpiry('09/16');
        $this->creditCard = new \CzechCash\Billers\Structures\CreditCards\CreditCard('4107857757053670', $expiry, 123);
    }


    public function testPayment()
    {
        $details = [
            'street' => 'abcd',
            'city' => 'efgh',
            'state' => 'cjdsfkjds',
            'country' => 'AD',
            'zip' => 'fjsdkfjsd'
        ];

        \Tester\Assert::true($this->biller->createCreditCardPayment(10, $this->creditCard, $details)->process());
    }

}


$testCase = new OptimalPaymentsBillerTest();
$testCase->run();