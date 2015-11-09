<?php

namespace CzechCash\Billers\Structures\CreditCards;

/**
 * Interface ICreditCard
 */
interface ICreditCard
{
	/**
	 * Gets credit card holder name
	 *
	 * @return string Credit card holder name
	 */
	public function getHolder();

    /**
     * Gets credit card number
     *
     * @return string Credit card number
     */
    public function getNumber();


    /**
     * Gets credit card CVV
     *
     * @return int CVV
     */
    public function getCvv();


    /**
     * @return ICreditCardExpiry
     */
    public function getExpiration();

	/**
	 * Get credit card expiration year
	 *
	 * @return int
	 */
	public function getExpiryYear();

	/**
	 * Get credit card expiration month
	 *
	 * @return int
	 */
	public function getExpiryMonth();


    /**
     * @return string Last digits of CC
     */
    public function getLastDigits();


    /**
     * @return bool Check if credit card is not expired
     */
    public function isNotExpired();


}