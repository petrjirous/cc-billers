<?php

namespace CzechCash\Billers\Structures\Payments;


interface IPayment
{

    /**
     * @return mixed
     */
    public function process();

    /**
     * @param $response
     * @return bool
     */
    public function validate($response);

    /**
     * Gets payment amount
     *
     * @return mixed
     */
    public function getAmount();

    /**
     * Gets all payment data
     *
     * @return mixed
     */
    public function getData();

}