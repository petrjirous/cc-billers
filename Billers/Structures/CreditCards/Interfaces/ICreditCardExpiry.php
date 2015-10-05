<?php

namespace CzechCash\Billers\Structures\CreditCards;



interface ICreditCardExpiry
{

    /**
     * Gets credit card expiration string
     *
     * @param string|null $format
     * @return string Expiration string. Example: '09/16'
     */
    public function getExpirationString($format = NULL);


    /**
     * Gets credit card expiration month
     *
     * @param string|null $format
     * @return string Expiration Month
     */
    public function getMonth($format = NULL);


    /**
     * Gets card expiration year
     *
     * @param $format string|null Year format 'y|Y'
     * @return string Expiration year
     */
    public function getYear($format = NULL);


    /**
     * @return bool Validates credit card expiration date
     */
    public function isValid();


}