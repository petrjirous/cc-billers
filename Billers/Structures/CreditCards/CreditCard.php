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

	/**
	 * @var string Credit card holder
	 */
	protected $holder;


    public function __construct($number, $expiration, $cvv, $holder)
    {
        $this->number = $number;
        $this->expiration = $expiration;
        $this->cvv = $cvv;
	    $this->holder = $holder;
    }

	/**
	 * @inheritDoc
	 */
	public function getHolder()
	{
		return $this->holder;
	}


	/**
     * @inheritDoc
     */
    public function getNumber()
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

	/**
	 * @inheritDoc
	 */
	public function getExpiryYear()
	{
		return $this->expiration->getYear("Y");
	}

	/**
	 * @inheritDoc
	 */
	public function getExpiryMonth()
	{
		return $this->expiration->getMonth("m");
	}
}