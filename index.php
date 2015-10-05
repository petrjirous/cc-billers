<?php

require_once 'vendor/autoload.php';

\Tracy\Debugger::enable();

\Tracy\Debugger::$maxDepth = 32;

$loader = new \Nette\Loaders\RobotLoader();

$loader->addDirectory('Billers');

$loader->setCacheStorage(new \Nette\Caching\Storages\FileStorage('cache'));

$loader->register();

$biller = new \CzechCash\Billers\Billers\OptimalPayments\OptimalPaymentsBiller();

var_dump($biller->isServiceAvailable());

$expiry = new \CzechCash\Billers\Structures\CreditCards\CreditCardExpiry('09/16');

$card = new \CzechCash\Billers\Structures\CreditCards\CreditCard('4107857757053670', $expiry, 123);

$details = [
    'street' => 'abcd',
    'city' => 'efgh',
    'state' => 'cjdsfkjds',
    'country' => 'AD',
    'zip' => 'fjsdkfjsd'
];

try {
    \Tracy\Debugger::dump($biller->createCreditCardPayment(10, $card, $details)->process());


}catch (OptimalPayments\NetbanxException $e) {
        \Tracy\Debugger::dump($e);
    }