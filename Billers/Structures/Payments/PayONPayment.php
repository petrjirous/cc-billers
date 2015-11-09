<?php
namespace CzechCash\Billers\Structures\Payments;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Structures\Payments
 */
class PayONPayment extends Payment
{
	/**
	 * @var ITransferDetails
	 */
	protected $transferDetails;

	/**
	 * PayONPayment constructor.
	 * @param ITransferDetails $transferDetails
	 */
	public function __construct(ITransferDetails $transferDetails)
	{
		$this->transferDetails = $transferDetails;
	}

	public function process(){
		$this->checkHandlers();

		$response = Callback::invoke($this->onProcess, $this->transferDetails);

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
	 * @inheritDoc
	 */
	public function validate($response)
	{
		return Callback::invoke($this->validate, $response);
	}

}