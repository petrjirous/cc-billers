<?php


namespace CzechCash\Billers;

/**
 * Interface IBiller
 */
interface IBiller
{

    /**
     * Checks if service is available
     *
     * @return bool
     */
    public function isServiceAvailable();

}