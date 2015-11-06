<?php
namespace CzechCash\Billers\Structures\Payments\Interfaces;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;
use CzechCash\Billers\Structures\Payments\IPayment;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers\Structures\Payments\Interfaces
 */
interface IBankTransferPayment extends IPayment
{

	/**
	 * @param ITransferDetails $transferDetails
	 * @return mixed
	 */
	public function setTransferDetails(ITransferDetails $transferDetails);

	/**
	 * @return ITransferDetails
	 */
	public function getTransferDetails();
}