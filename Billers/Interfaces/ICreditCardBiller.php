<?php

namespace CzechCash\Billers;


use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use CzechCash\Billers\Structures\Payments\ICreditCardPayment;

interface ICreditCardBiller
{

    /**
     * @param $amount
     * @param ICreditCard $card
     * @param $details
     * @return ICreditCardPayment
     */
    public function createCreditCardPayment($amount, ICreditCard $card, $details);

    /**
     * @param ICreditCard $card
     * @return array
     */
    public static function formatCreditCard(ICreditCard $card);

}