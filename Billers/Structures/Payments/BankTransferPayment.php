<?php
namespace CzechCash\Billers\Structures\Payments;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use CzechCash\Billers\Structures\Payments\Interfaces\IBankTransferPayment;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Structures\Payments
 */
class BankTransferPayment extends Payment implements IBankTransferPayment
{
	/**
	 * @var ITransferDetails
	 */
	protected $transferDetails;
	/**
	 * @var double
	 */
	protected $amount;

	/**
	 * BankTransferPayment constructor.
	 * @param ITransferDetails $transferDetails
	 * @param float $amount
	 */
	public function __construct(ITransferDetails $transferDetails, $amount)
	{
		$this->transferDetails = $transferDetails;
		$this->amount = $amount;
	}

	public function process(){
		$this->checkHandlers();

		$response = Callback::invoke($this->onProcess, $this->amount, $this->transferDetails);

		if($this->validate){
			if($this->validate($response)){
				return Callback::invoke($this->onSuccess, $response);
			}

			return Callback::invoke($this->onFailure, $response);
		}

		return $response;
	}


	/**
	 * @inheritDoc
	 */
	public function setTransferDetails(ITransferDetails $transferDetails)
	{
		$this->transferDetails = $transferDetails;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function getTransferDetails()
	{
		return $this->transferDetails;
	}

	/**
	 * @return float
	 */
	public function getAmount()
	{
		return $this->amount;
	}

	/**
	 * @param float $amount
	 */
	public function setAmount($amount)
	{
		$this->amount = $amount;
	}

	/**
	 * @inheritDoc
	 */
	public function validate($response)
	{
		return Callback::invoke($this->validate, $response);
	}

}