<?php

namespace CzechCash\Billers\Structures\CreditCards;


class CreditCard implements ICreditCard
{

    /**
     * @var string Credit card number
     */
    protected $last4Digits;

    /**
     * @var ICreditCardExpiry Credit card expiration
     */
    protected $expiration;

	/**
	 * @var string Credit card holder
	 */
	protected $holder;


    public function __construct($number, $expiration, $holder)
    {
        $this->last4Digits = $number;
        $this->expiration = $expiration;
	    $this->holder = $holder;
    }

	/**
	 * @return string
	 */
	public function getLast4Digits()
	{
		return $this->last4Digits;
	}

	/**
	 * @param string $last4Digits
	 * @return CreditCard
	 */
	public function setLast4Digits($last4Digits)
	{
		$this->last4Digits = $last4Digits;
		return $this;
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
    public function getExpiration()
    {
        return $this->expiration;
    }


    /**
     * @inheritDoc
     */
    public function isNotExpired()
    {
        return $this->expiration->isValid() === false;
    }
}