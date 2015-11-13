<?php
namespace Billers\Webbilling;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use CzechCash\Billers\Structures\Payments\Interfaces\IBankTransferPayment;
use CzechCash\Billers\Structures\Payments\BasePayment;
use Nette\Utils\Callback;


/**
 *
 *
 * @author Kenny
 * @package Billers\Webbilling
 */
class BankTransferBasePayment extends BasePayment implements IBankTransferPayment
{

	/**
	 * @var ITransferDetails
	 */
	protected $transferDetails;

	/**
	 * BankTransferBasePayment constructor.
	 * @param ITransferDetails $transferDetails
	 */
	public function __construct(ITransferDetails $transferDetails)
	{
		$this->transferDetails = $transferDetails;
	}

	public function process()
	{
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
	public function validate($response)
	{
		return Callback::invoke($this->validate, $response);
	}

	/**
	 * @inheritDoc
	 */
	public function setTransferDetails(ITransferDetails $transferDetails)
	{
		$this->transferDetails = $transferDetails;
	}

	/**
	 * @inheritDoc
	 */
	public function getTransferDetails()
	{
		return $this->transferDetails;
	}

}