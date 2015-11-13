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
     * Gets last 4 digits from card number
     *
     * @return string Credit card number
     */
    public function getLast4Digits();

    /**
     * @return ICreditCardExpiry
     */
    public function getExpiration();

    /**
     * @return bool Check if credit card is not expired
     */
    public function isNotExpired();


}