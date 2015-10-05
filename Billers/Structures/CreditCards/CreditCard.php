<?php

namespace CzechCash\Billers\Structures\CreditCards;


class CreditCard implements ICreditCard
{

    /**
     * @var string Credit card number
     */
    protected $number;

    /**
     * @var ICreditCardExpiry Credit card expiration
     */
    protected $expiration;

    /**
     * @var string Credit card CVV
     */
    protected $cvv;


    public function __construct($number, $expiration, $cvv)
    {
        $this->number = $number;
        $this->expiration = $expiration;
        $this->cvv = $cvv;
    }


    /**
     * @inheritDoc
     */
    public function getCardNumber()
    {
        return $this->number;
    }

    /**
     * @inheritDoc
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @inheritDoc
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @inheritDoc
     */
    public function getLastDigits()
    {
        return substr($this->number, -4);
    }

    /**
     * @inheritDoc
     */
    public function isNotExpired()
    {
        return $this->expiration->isValid() === false;
    }
}