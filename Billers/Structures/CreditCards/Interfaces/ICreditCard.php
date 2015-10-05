<?php

namespace CzechCash\Billers\Structures\CreditCards;

/**
 * Interface ICreditCard
 */
interface ICreditCard
{

    /**
     * Gets credit card number
     *
     * @return string Credit card number
     */
    public function getCardNumber();


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
     * @return string Last digits of CC
     */
    public function getLastDigits();


    /**
     * @return bool Check if credit card is not expired
     */
    public function isNotExpired();


}