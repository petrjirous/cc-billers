<?php

namespace CzechCash\Billers\Structures\Payments;


use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use OptimalPayments\HostedPayment\Callback;

class CreditCardPayment extends Payment implements ICreditCardPayment
{
    /**
     * @var ICreditCard
     */
    protected $creditCard;

    /**
     * @var double
     */
    protected $amount;

    /**
     * @var array
     */
    protected $billingDetails;



    public function __construct($amount, ICreditCard $card, $details = [])
    {
        $this->amount = $amount;
        $this->creditCard = $card;
        $this->billingDetails = $details;
    }


    /**
     * @inheritDoc
     */
    public function process()
    {
        $this->checkHandlers();

        $response = \Nette\Utils\Callback::invoke($this->onProcess, $this->amount, $this->creditCard, $this->billingDetails);

        if($this->validate)
        {
            if($this->validate($response))
            {
                return \Nette\Utils\Callback::invoke($this->onSuccess, $response);
            }

            return \Nette\Utils\Callback::invoke($this->onFailure, $response);
        }

        return $response;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return array
     */
    public function getBillingDetails()
    {
        return $this->billingDetails;
    }

    /**
     * @param array $billingDetails
     */
    public function setBillingDetails($billingDetails)
    {
        $this->billingDetails = $billingDetails;
    }




    /**
     * Sets credit card for payment
     *
     * @param $creditCard ICreditCard
     * @return mixed
     */
    public function setCreditCard(ICreditCard $creditCard)
    {
        $this->creditCard = $creditCard;
    }

    /**
     * @return \CzechCash\Billers\Structures\CreditCards\ICreditCard
     */
    public function getCreditCard()
    {
        return $this->creditCard;
    }

    /**
     * @param $response
     * @return bool
     */
    public function validate($response)
    {
        return \Nette\Utils\Callback::invoke($this->validate, $response);
    }
}