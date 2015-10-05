<?php

namespace CzechCash\Billers\Structures\Payments;


use CzechCash\Billers\Structures\CreditCards\ICreditCard;

interface ICreditCardPayment extends IPayment
{

    /**
     * Sets credit card for payment
     *
     * @param $creditCard ICreditCard
     * @return mixed
     */
    public function setCreditCard(ICreditCard $creditCard);

    /**
     * @return \CzechCash\Billers\Structures\CreditCards\ICreditCard
     */
    public function getCreditCard();

}