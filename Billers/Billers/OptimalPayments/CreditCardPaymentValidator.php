<?php
/**
 * Created by PhpStorm.
 * User: petr
 * Date: 14/09/15
 * Time: 22:04
 */

namespace CzechCash\Billers\Billers\OptimalPayments;


use Nette\Utils\Validators;
use OptimalPayments\CardPayments\Authorization;
use Tracy\Debugger;

class CreditCardPaymentValidator
{

    public function __invoke(Authorization $response)
    {
        return $response->status === "COMPLETED";
    }

}