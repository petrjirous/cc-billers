<?php

namespace CzechCash\Billers\Structures\Payments;


use Nette\Utils\Callback;

abstract class BasePayment implements IPayment
{

    /**
     * @var callable
     */
    public $onSuccess;


    /**
     * @var callable
     */
    public $onFailure;

    /**
     * @var callable Process handlers
     */
    public $onProcess;

    /**
     * @var callable
     */
    public $validate;

    /**
     * @inheritDoc
     */
    public function process()
    {
        foreach($this->onProcess as $callback)
        {
            Callback::invoke($callback);
        }
    }


    /**
     * @throws \HandlerNotSetException
     */
    protected function checkHandlers()
    {
        if(!$this->onFailure || !is_callable($this->onFailure))
        {
            throw new \HandlerNotSetException("'onFailure' handler not set for class '" . get_class($this) . "'");
        }

        if(!$this->onSuccess || !is_callable($this->onSuccess))
        {
            throw new \HandlerNotSetException("'onSuccess' handler not set for class '" . get_class($this) . "'");
        }
    }


    /**
     * @inheritDoc
     */
    public function getAmount()
    {
        // TODO: Implement getAmount() method.
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }


}