<?php

namespace CzechCash\Billers\Billers;


use CzechCash\Billers\IBiller;
use CzechCash\Billers\Structures\CreditCards\ICreditCard;
use Kdyby\Curl\InvalidStateException;
use Kdyby\Curl\Request;
use Nette\Http\RequestFactory;
use Nette\Http\Response;
use Nette\Http\Session;
use Nette\Neon\Neon;

abstract class BaseBiller implements IBiller
{
    /** @var  array Basic biller configuration */
    protected $config;

    /** @var  string */
    protected $configFile;

	protected $response;

	protected $paymentSection;

	protected $session;


    public function __construct()
    {
        $this->loadConfiguration();

	    $requestFactory = new RequestFactory();
	    $request = $requestFactory->createHttpRequest();
	    $this->response = new Response();

	    $this->session = new Session($request, $this->response);

	    $this->paymentSection = $this->session->getSection('payment');

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