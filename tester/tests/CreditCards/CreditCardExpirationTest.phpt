<?php

require __DIR__ . '/../../bootstrap.php';


/**
 * Created by PhpStorm.
 * User: petr
 * Date: 15/09/15
 * Time: 13:07
 */
class CreditCardExpirationTest extends \Tester\TestCase
{

    public function setUp()
    {

    }


    public function testExpired()
    {
        $expiry = new \CzechCash\Billers\Structures\CreditCards\CreditCardExpiry('09/14');
        $creditCard = new \CzechCash\Billers\Structures\CreditCards\CreditCard('18989898', $expiry, 326);

        \Tester\Assert::false($creditCard->isNotExpired());
    }

}

$testCase = new CreditCardExpirationTest();
$testCase->run();