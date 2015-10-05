<?php

namespace CzechCash\Billers\Structures\CreditCards;


class CreditCardExpiry implements ICreditCardExpiry
{

    const EXPIRATION_DATE_FORMAT = 'm/y';
    const EXPIRATION_MONTH_FORMAT = 'm';
    const EXPIRATION_YEAR_FORMAT = 'y';


    /** @var  \DateTime */
    protected $expiration;


    public function __construct($expiration)
    {
        if(is_object($expiration) && $expiration instanceof \DateTime)
        {
            $this->expiration = $expiration;
            return ;
        }

        $this->expiration = \DateTime::createFromFormat(self::EXPIRATION_DATE_FORMAT, $expiration);
    }


    /**
     * Gets credit card expiration string
     *
     * @param string|null $format
     * @return string Expiration string. Example: '09/16'
     */
    public function getExpirationString($format = NULL)
    {
        if(!$format)
        {
            $format = self::EXPIRATION_DATE_FORMAT;
        }

        return $this->expiration->format($format);
    }

    /**
     * Gets credit card expiration month
     *
     * @param string|null $format
     * @return string Expiration Month
     */
    public function getMonth($format = NULL)
    {
        if(!$format)
        {
            $format = self::EXPIRATION_MONTH_FORMAT;
        }

        return $this->expiration->format($format);
    }

    /**
     * Gets card expiration year
     *
     * @param $format string|null Year format 'y|Y'
     * @return string Expiration year
     */
    public function getYear($format = NULL)
    {
        if(!$format)
        {
            $format = self::EXPIRATION_YEAR_FORMAT;
        }

        return $this->expiration->format($format);
    }


    /**
     * @return string Expiration string. Example: '09/16'
     */
    public function __toString()
    {
        return $this->getExpirationString();
    }


    /**
     * @return bool Validates credit card expiration date
     */
    public function isValid()
    {
        return (new \DateTime()) < $this->expiration;
    }
}