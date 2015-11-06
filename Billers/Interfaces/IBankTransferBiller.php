<?php
namespace CzechCash\Billers;
use CzechCash\Billers\Structures\BankTransfers\Interfaces\ITransferDetails;


/**
 *
 *
 * @author Kenny
 * @package CzechCash\Billers
 */
interface IBankTransferBiller
{
	public function createBankTransferPayment($amount, ITransferDetails $transferDetails);
}