<?php

namespace CzechCash\Billers\Billers\OptimalPayments;

use CzechCash\Billers\Billers\BaseBiller;
use CzechCash\Billers\ICreditCardBiller;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use CzechCash\Billers\Structures\Payments\CreditCardPayment;
use CzechCash\Billers\Structures\Payments\ICreditCardPayment;
use Nette\Utils\Callback;
use Nette\Utils\Random;
use OptimalPayments\CardPayments\Authorization;
use OptimalPayments\Environment;
use OptimalPayments\OptimalApiClient;
use Tracy\Debugger;

class OptimalPaymentsBiller extends BaseBiller implements ICreditCardBiller
{
    protected $configFile = __DIR__ . '/config/optimalPayments.neon';


    /**
     * @var OptimalApiClient
     */
    protected $client;


    public function __construct()
    {
        parent::__construct();

        $this->client = new OptimalApiClient($this->config['apiKey'], $this->config['apiSecret'], Environment::TEST, $this->config['accountID']);
    }


    /**
     * Checks if service is available
     *
     * @return bool
     */
    public function isServiceAvailable()
    {
        return $this->client->cardPaymentService()->monitor();
    }


    public function testPayment($amount, ICreditCard $card, $details = [])
    {
        $auth = new Authorization([
            'merchantRefNum' => Random::generate(10, '0-9'),
            'amount' => $amount,
            'settleWithAuth' => true,
            'card' => self::formatCreditCard($card),
            'billingDetails' => $details
        ]);

        return $this->client->cardPaymentService()->authorize($auth);
    }


    public static function formatCreditCard(ICreditCard $card)
    {
        return [
            'cardNum' => $card->getNumber(),
            'cvv' => (int)$card->getCvv(),
            'cardExpiry' => [
                'month' => (int)$card->getExpiration()->getMonth(),
                'year' => (int)$card->getExpiration()->getYear('Y')
            ]
        ];
    }

    /**
     * @param $amount
     * @param ICreditCard $card
     * @param $details
     * @return ICreditCardPayment
     */
    public function createCreditCardPayment($amount, ICreditCard $card, $details)
    {
        $payment = new CreditCardPayment($amount, $card, $details);
        $payment->setCreditCard($card);
        $payment->onProcess = [$this, 'testPayment'];
        $payment->validate = new CreditCardPaymentValidator();
        $payment->onFailure = function ($response) {
            return false;
        };
        $payment->onSuccess = function ($response) {
            return true;
        };
        return $payment;
    }
}