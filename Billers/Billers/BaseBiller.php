<?php

namespace CzechCash\Billers\Billers;


use CzechCash\Billers\IBiller;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use Kdyby\Curl\InvalidStateException;
use Kdyby\Curl\Request;
use Nette\Neon\Neon;

abstract class BaseBiller implements IBiller
{
    /** @var  array Basic biller configuration */
    protected $config;

    /** @var  string */
    protected $configFile;



    public function __construct()
    {
        $this->loadConfiguration();
    }


    /**
     * Load biller configuration
     *
     * @param string|null $file
     */
    protected function loadConfiguration($file = NULL)
    {
        if($file)
        {
            $this->config = Neon::decode(file_get_contents($file));
            return;
        }

        if(!$this->configFile)
        {
            throw new InvalidStateException("No configuration file set for biller '". get_class($this) . "'");
        }

        $this->config = Neon::decode(file_get_contents($this->configFile));
    }


}